<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Log;



class MenuController extends Controller
{
    public function index(Request $request)
    {
        $sortField = $request->input('sort', 'name'); // Default sort by name
        $sortDirection = $request->input('direction', 'asc'); // Default direction is ascending
        $perPage = $request->input('per_page', 10); // Default items per page is 10

        if ($perPage === 'all') {
            $menuItems = Menu::orderBy($sortField, $sortDirection)->get();
        } else {
            $menuItems = Menu::orderBy($sortField, $sortDirection)->paginate((int) $perPage);
        }

        return view('admin_menu_list', compact('menuItems', 'sortField', 'sortDirection', 'perPage'));
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

        $menu = new Menu();
        $menu->name = $request->input('name');
        $menu->description = $request->input('description');
        $menu->price = $request->input('price');
        $menu->category = $request->input('category');
        $menu->save();

        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $fileName = Str::slug($menu->name) . '_MenuImage.' . $request->file('photo')->getClientOriginalExtension();

            $imageManager = new ImageManager(['driver' => 'gd']);
            $image = $imageManager->make($request->file('photo')->getRealPath())
                ->resize(1920, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })
                ->encode();

            $saved = Storage::put('uploads/menu_image/' . $fileName, $image);

            if (!$saved) {
                Log::error('Failed to save file: ' . $fileName);
            } else {
                Log::info('File saved successfully: ' . $fileName);
            }

            $menu->photo = $fileName;
            $menu->save();
        } else {
            Log::error('Invalid or missing file upload.');
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
