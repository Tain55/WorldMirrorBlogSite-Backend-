<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        return Blog::with('user', 'category')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $blog = Blog::create([
            'title'        => $request->title,
            'content'      => $request->content,
            'slug'         => Str::slug($request->title),
            'image'        => $request->image ?? null,
            'is_published' => $request->is_published ?? false,
            'user_id'      => auth()->id(), // From Token
            'category_id'  => $request->category_id,
        ]);

        return response()->json($blog, 201);
    }

    public function show($slug)
    {
        return Blog::with('user', 'category')
                ->where('slug', $slug)
                ->firstOrFail();
    }

    public function yourblog($id)
    {
        return Blog::with('user', 'category')
                ->where('user_id', $id)
                ->get();
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $blog->update([
            'title'        => $request->title ?? $blog->title,
            'content'      => $request->content ?? $blog->content,
            'slug'         => $request->title ? Str::slug($request->title) : $blog->slug,
            'image'        => $request->image ?? $blog->image,
            'is_published' => $request->is_published ?? $blog->is_published,
            'category_id'  => $request->category_id ?? $blog->category_id,
        ]);

        return response()->json($blog);
    }

    public function destroy($slug)
    {
        $blog = Blog::where('slug', $slug) -> firstOrFail();
        $blog->delete();
        
        return response()->json(['message' => 'Blog deleted']);
    }
}
