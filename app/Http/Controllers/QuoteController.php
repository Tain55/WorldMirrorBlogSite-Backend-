<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quote;

class QuoteController extends Controller
{
    public function index(){
        $quotes = Quote::all();
        return response()->json($quotes, 200);
    }

    public function store(Request $request){
        $data = $request->validate([
            'author' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'quote' => 'required|string',
            'image' => 'nullable|string'
        ]);

        $quote = Quote::create($data); // validated data ব্যবহার করা
        return response()->json($quote, 201);
    }

    public function show($id){
        $quote = Quote::find($id);
        if(!quote) {
            return response()->json(['message'=>'Quote not found'], 404);
        }
        return response()->json($quote, 200);
    }
    public function update(Request $request, $id){
        $quote = Quote::find($id);
        if(!$quote){
            return response()->json(['message'=>'Quote not found'], 404);
        }

        $quote->update($request->all());
        return response()->json($quote, 200);
    }
    public function destroy($id){
        $quote = Quote::find($id);

        if(!$quote){
            return response()->json(['message'=>'Quote not found'], 404);
        }

        $quote->delete();
        return response()->json(['message'=>'Quote deleted successfully'], 200);
    }
}
