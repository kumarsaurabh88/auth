<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Image;

class BlogImageController extends Controller
{
    public function store(Request $request)
    
    {
        dd($request->all());
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|string',
            'image' => 'required|array',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000', // Adjust validation rules for multiple images
        ]);

        $blog = new Blog();
        $blog->name = $request->name;
        $blog->description = $request->description;
        $blog->price = $request->price;
        $blog->save();

        // Handle multiple image uploads
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                if ($image->isValid()) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images'), $imageName);

                    // Save image path to database
                    $blogImage = new Image();
                    $blogImage->blog_id = $blog->id;
                    $blogImage->image_path = 'images/' . $imageName;
                    $blogImage->save();
                }
            }
        }

        return redirect()->route('blogs.index')->with('success', 'Blog added successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|string',
            'image' => 'array',
            'image.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000', // Adjust validation rules for multiple images
        ]);

        $blog = Blog::findOrFail($id);
        $blog->name = $request->name;
        $blog->description = $request->description;
        $blog->price = $request->price;
        $blog->save();

        // Handle multiple image uploads
        if ($request->hasFile('image')) {
            foreach ($request->file('images') as $image) {
                if ($image->isValid()) {
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images'), $imageName);

                    // Save image path to database
                    $blogImage = new Image();
                    $blogImage->blog_id = $blog->id;
                    $blogImage->image_path = 'images/' . $imageName;
                    $blogImage->save();
                }
            }
        }

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
    }
}
