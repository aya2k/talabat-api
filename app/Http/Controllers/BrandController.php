<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Claims\Expiration;
use Exception;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands= Brand::all();
        return response()->json($brands , 200);
    }

   
    
    public function store(Request $request)
    {
        try{
            $validation=$request->validate([
                'name'=>'required|unique|string|max:255',
            ]);
            $brand= new Brand();
            $brand->name =$request->name;
            $brand->save();
            return response()->json('brand added successfully' , 201);

        }catch(Exception $e){
            return response()->json($e ,500);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand=Brand::find($id);
         if ($brand){
            return response()->json($brand ,'200');
         }else {
            return 'the brand not found';
         }
        
    }

    
    public function update(Request $request, string $id)
    {
        try{
            $validation=$request->validate([
                'name'=>'required|unique|string|max:255',
            ]);
            Brand::where ('id',$id)->update('name',$request->name);
            return response()->json('name of brand updated' ,200);
        }catch(Exception $e){
            return response()->json($e ,500);
        }   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $brand=Brand::find($id);
       if ($brand){
        $brand->delete();
        return response()->json('the brand is deleted' ,200);
       }else {
        return response()->json('the brand is not found');
       }
    }
}
