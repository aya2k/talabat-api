<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Claims\Expiration;
use Exception;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $Category= Category::all();
        return response()->json($Category , 200);
    }

   
    
    public function store(Request $request)
{
    try {
        // Validate request data
        $validation = $request->validate([
            'name'  => 'required|string|max:255|unique:categories,name',
            'image' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $Category = new Category();
        $Category->name = $request->name;
        

        // Handle file upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads', 'public');
            $Category->image_path = $path; // Assuming 'image_path' column exists in categories table
        }

        // Save category
        $Category->save();

        return response()->json([
            'message' => 'Category added successfully',
            'category' => $Category
        ], 201);

    } catch(Exception $e) {
        return response()->json([
            'error' => $e->getMessage()
        ], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $Category=Category::find($id);
         if ($Category){
            return response()->json($Category ,'200');
         }else {
            return 'the Category not found';
         }
        
    }

    

    
    public function update(Request $request, string $id)
{
    try {
        // Validate request
        $validation = $request->validate([
            'name'  => 'required|string|max:255|unique:categories,name,'.$id,
            'image' => 'nullable|file|mimes:jpg,png,pdf|max:2048', // Image is optional
        ]);

        // Find category
        $category = Category::findOrFail($id);

        // Update name
        $category->name = $request->name;

        // Handle file update if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old file if it exists
            if ($category->image_path) {
                Storage::disk('public')->delete($category->image_path);
            }

            // Store new file
            $path = $request->file('image')->store('uploads', 'public');
            $category->image_path = $path;
        }

        // Save changes
        $category->save();

        return response()->json([
            'message'  => 'Category updated successfully',
            'category' => $category
        ], 200);

    } catch (Exception $e) {
        return response()->json([
            'error' => $e->getMessage()
        ], 500);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $Category=Category::find($id);
       if ($Category){
        $Category->delete();
        return response()->json('the Category is deleted' ,200);
       }else {
        return response()->json('the Category is not found');
       }
    }
}

