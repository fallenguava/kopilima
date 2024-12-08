<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;


class MenuController extends Controller
{
    /**
     * Display a list of all menu items for the admin.
     */
    public function index()
    {
        $menuItems = Menu::all();
        return view('admin_menu_list', compact('menuItems'));
    }

    /**
     * Show the form for creating a new menu item.
     */
    public function create()
    {
        return view('admin_menu_create');
    }

    /**
     * Store a newly created menu item in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|string|max:255'
        ]);

        // Create a new menu item
        $menu = new Menu();
        $menu->name = $request->input('name');
        $menu->description = $request->input('description');
        $menu->price = $request->input('price');
        $menu->category = $request->input('category');
        $menu->save();

        // Handle photo upload and resizing
        if ($request->hasFile('photo')) {
            $fileName = Str::slug($menu->name) . '_MenuImage.' . $request->file('photo')->getClientOriginalExtension();

            // Instantiate ImageManager with 'gd' driver
            $imageManager = new ImageManager(['driver' => 'gd']);

            // Resize and save the image
            $image = $imageManager->make($request->file('photo')->getRealPath())
                ->resize(1920, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode();

            Storage::put('public/uploads/menu_image/' . $fileName, $image);

            $menu->photo = $fileName;
            $menu->save();
        }

        return redirect()->route('admin.menu.index')->with('success', 'Menu item created successfully.');
    }

    /**
     * Show the form for editing the specified menu item.
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin_menu_edit', compact('menu'));
    }

    /**
     * Update the specified menu item in the database.
     */
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|string|max:255'
        ]);

        $menu = Menu::findOrFail($id);
        $menu->name = $request->input('name');
        $menu->description = $request->input('description');
        $menu->price = $request->input('price');
        $menu->category = $request->input('category');

        // Handle photo upload and resizing
        if ($request->hasFile('photo')) {
            // Delete the old photo
            if ($menu->photo) {
                Storage::delete('public/uploads/menu_image/' . $menu->photo);
            }

            $fileName = Str::slug($menu->name) . '_MenuImage.' . $request->file('photo')->getClientOriginalExtension();

            // Instantiate ImageManager with 'gd' driver
            $imageManager = new ImageManager(['driver' => 'gd']);

            // Resize and save the new image
            $image = $imageManager->make($request->file('photo')->getRealPath())
                ->resize(1920, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode();

            Storage::put('public/uploads/menu_image/' . $fileName, $image);

            $menu->photo = $fileName;
        }

        $menu->save();

        return redirect()->route('admin.menu.index')->with('success', 'Menu item updated successfully.');
    }


    /**
     * Remove the specified menu item from the database.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);

        // Delete the photo file if it exists
        if ($menu->photo) {
            Storage::delete('public/menu_images/' . $menu->photo);
        }

        $menu->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu item deleted successfully.');
    }
}
