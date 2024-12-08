<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in
        if (Auth::attempt($request->only('email', 'password'))) {
            // Invalidate and regenerate the session
            $request->session()->regenerate();

            // Load the data required for the admin_ongoing_orders view
            $ongoingOrders = \App\Models\OngoingOrder::all();
            $grossIncome = \App\Models\FinishedOrder::sum('final_price');

            // Redirect to the admin_ongoing_orders view
            return redirect(route('admin.home'))->with('success', 'Logged in successfully');
        }

        // If login fails, return back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function home()
    {
        return view('admin_home', [
            'totalOngoingOrders' => \App\Models\OngoingOrder::count(),
            'totalFinishedOrders' => \App\Models\FinishedOrder::count(),
            'totalCanceledOrders' => \App\Models\CanceledOrder::count(),
            'grossIncome' => \App\Models\FinishedOrder::sum('final_price'),
            'totalMenuItems' => \App\Models\Menu::count(),
            'totalAdmins' => \App\Models\User::where('role', 'admin')->count(),
        ]);
    }


    public function logout(Request $request)
    {
        // Logout the user
        Auth::logout();

        // Invalidate and regenerate a new session token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the login page
        return redirect('/login')->with('success', 'Logged out successfully');
    }
}
