<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\OngoingOrder;
use App\Models\FinishedOrder;
use App\Models\CanceledOrder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function showMenu()
    {
        return view('customer_menu', [
            'coffeeItems' => Menu::where('category', 'Coffee')->get(),
            'snackItems' => Menu::where('category', 'Snacks')->get(),
            'friesItems' => Menu::where('category', 'Fries')->get(),
            'riceItems' => Menu::where('category', 'Rice')->get(),
            'dessertItems' => Menu::where('category', 'Dessert')->get(),
            'drinkItems' => Menu::where('category', 'Drinks')->get(),
        ]);
    }

    public function addToCart(Request $request)
    {
        $cart = Session::get('cart', []);
        $itemId = $request->input('id');
        $menuItem = Menu::find($itemId);

        if ($menuItem) {
            if (isset($cart[$itemId])) {
                $cart[$itemId]['quantity'] += 1;
            } else {
                $cart[$itemId] = [
                    'id' => $menuItem->id,
                    'name' => $menuItem->name,
                    'price' => $menuItem->price,
                    'photoUrl' => asset('storage/menu_images/' . $menuItem->photo),
                    'quantity' => 1,
                ];
            }
            Session::put('cart', $cart);
        }

        return response()->json($cart);
    }

    public function viewCart(Request $request)
    {
        $cartItems = Session::get('cart', []);
        $subTotal = array_reduce($cartItems, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
        $finalPrice = round($subTotal * 1.17, 2);

        // Check if the request expects JSON (like when called via fetch())
        if ($request->expectsJson()) {
            return response()->json($cartItems); // Return only cart items for JavaScript
        }

        // Otherwise, return the view for regular page load
        return view('customer_cart', [
            'cartItems' => $cartItems,
            'subTotal' => $subTotal,
            'finalPrice' => $finalPrice,
        ]);
    }


    public function processCheckout(Request $request)
    {
        $cartItems = Session::get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('cart.view')->withErrors('Cart is empty.');
        }

        $customerName = $request->input('customer_name');
        $tableNumber = $request->input('table_number');
        $email = $request->input('email');

        Session::put('customer_name', $customerName);
        Session::put('table_number', $tableNumber);
        Session::put('email', $email); // Store email in session

        return redirect()->route('cart.checkout');
    }

    public function checkout()
    {
        $cartItems = Session::get('cart', []);
        $customerName = Session::get('customer_name');
        $tableNumber = Session::get('table_number');
        $email = Session::get('email'); // Retrieve email from session

        $subTotal = array_reduce($cartItems, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
        $finalPrice = round($subTotal * 1.17, 2);

        // Generate the next sequential order ID
        $lastOrder = DB::table('ongoing_orders')->orderBy('order_id', 'desc')->first();
        $orderId = $lastOrder ? $lastOrder->order_id + 1 : 1;

        return view('customer_pay', [
            'cartItems' => $cartItems,
            'subTotal' => $subTotal,
            'finalPrice' => $finalPrice,
            'customerName' => $customerName,
            'tableNumber' => $tableNumber,
            'email' => $email,
            'orderId' => $orderId,
        ]);
    }

    public function resetAndDeleteOrders()
    {
        // Delete all records from the ongoing_orders table
        OngoingOrder::truncate();

        return redirect()->route('admin.ongoingOrders')->with('success', 'All orders have been deleted, and Order IDs reset!');
    }

    public function resetOrderIds()
    {
        $ongoingOrders = OngoingOrder::all();

        DB::transaction(function () use ($ongoingOrders) {
            foreach ($ongoingOrders as $index => $order) {
                $order->order_id = $index + 1; // Reset order_id sequentially starting from 1
                $order->save();
            }
        });

        return redirect()->route('admin.ongoingOrders')->with('success', 'Order IDs have been reset successfully!');
    }

    public function submitOrder(Request $request)
    {
        $cartItems = Session::get('cart', []);
        $customerName = Session::get('customer_name');
        $tableNumber = Session::get('table_number');
        $email = Session::get('email'); // Retrieve email from session

        if (empty($cartItems)) {
            return redirect()->back()->withErrors('Order submission failed: cart data is missing.');
        }

        $allItems = implode(', ', array_map(function ($item) {
            return "{$item['name']} ({$item['quantity']})";
        }, $cartItems));

        $orderId = $request->input('order_id');

        DB::table('ongoing_orders')->insert([
            'order_id' => $orderId,
            'all_items' => $allItems,
            'final_price' => $request->input('final_price'),
            'customer_name' => $customerName,
            'email' => $email, // Add email field here
            'table_number' => $tableNumber,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Session::forget(['cart', 'customer_name', 'table_number', 'email']);

        return redirect()->route('customer.menu')->with('success', 'Order has been submitted successfully!');
    }


    public function viewOngoingOrders()
    {
        $ongoingOrders = OngoingOrder::all();
        $grossIncome = FinishedOrder::sum('final_price');

        return view('admin_ongoing_orders', [
            'ongoingOrders' => $ongoingOrders,
            'grossIncome' => $grossIncome,
        ]);
    }

    public function finishOrder(Request $request, $id)
    {
        // Retrieve the order using the primary key (order_id)
        $order = OngoingOrder::where('order_id', $id)->firstOrFail();

        // Insert the order data into the finished_orders table
        FinishedOrder::create([
            'order_id' => $order->order_id,
            'all_items' => $order->all_items,
            'final_price' => $order->final_price,
            'customer_name' => $order->customer_name,
            'email' => $order->email,
            'table_number' => $order->table_number,
        ]);

        // Delete the order from ongoing_orders
        $order->delete();

        return redirect()->route('admin.ongoingOrders')->with('success', 'Order has been marked as finished.');
    }

    public function cancelOrder(Request $request, $id)
    {
        // Retrieve the order using the primary key (order_id)
        $order = OngoingOrder::where('order_id', $id)->firstOrFail();

        // Insert the order data into the canceled_orders table
        CanceledOrder::create([
            'order_id' => $order->order_id,
            'all_items' => $order->all_items,
            'final_price' => $order->final_price,
            'customer_name' => $order->customer_name,
            'email' => $order->email,
            'table_number' => $order->table_number,
        ]);

        // Delete the order from ongoing_orders
        $order->delete();

        return redirect()->route('admin.ongoingOrders')->with('success', 'Order has been canceled.');
    }
}
