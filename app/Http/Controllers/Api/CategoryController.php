<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        if($categories->count() > 0)
        {
            return CategoryResource::collection($categories);
        }
        else
        {
            return response()->json(['message'=> 'Success but No record available' ],200);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'category_name' => 'required|string|max:255'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validator->messages(),
            ],422);
        }

        $category = Category::create([
            'category_name' => $request->category_name
        ]);

        return response()->json([
            'message'=>'Data created successfully',
            'data' => new CategoryResource($category)
        ],200);
    }

    public function show($id)
    {
        $category = Category::find($id);


        if(!$category){
            return response()->json([
                "message" => "The category is not in the list."
            ],404);
        }

        return new CategoryResource($category);
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(),[
            'category_name' => 'required|string|max:255'
        ]);

        if($validator->fails())
        {
            return response()->json([
                'message' => 'All fields are mandetory',
                'error' => $validator->messages(),
            ],422);
        }

        $category->update([
            'category_name' => $request->category_name
        ]);

        return response()->json([
            'message'=>'Data updated successfully',
            'data' => new CategoryResource($category)
        ],200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => 'Data is not available or already deleted'
            ], 404);
        }

        $category->delete();

        return response()->json([
            'message' => 'Data deleted successfully'
        ], 200);
    }


}