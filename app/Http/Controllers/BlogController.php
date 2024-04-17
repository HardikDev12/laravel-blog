<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
    public function create()
    {
        $categories = DB::table('category')->get();
        return view('createBlog', compact('categories'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max size 2MB
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|in:0,1',
        ]);

        // Check if file was uploaded
        if ($request->hasFile('image')) {
            // Handle file upload
            $imageName = $request->file('image')->getClientOriginalName();

            // Store file in public/images directory
            $request->file('image')->storeAs('public/images', $imageName);

            DB::table('blogs')->insert([
                'title' => $request->title,
                'category' => $request->category,
                'image' => $imageName,
                'startdate' => $request->start_date,
                'enddate' => $request->end_date,
                'description' => $request->description,
                'status' => $request->status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
        } else {
            return back()->withInput()->withErrors(['image' => 'Please upload an image.']);
        }
    }


    public function index()
    {
        $currentDate = Carbon::now()->toDateString();

        $blogs = DB::table('blogs')
            ->where('status', '=', 0) // Published blogs
            ->whereDate('enddate', '>=', $currentDate) 
            ->orderByRaw("CASE WHEN startdate = '$currentDate' THEN 0 ELSE 1 END")
            ->orderBy('startdate', 'ASC')
            ->paginate(9);

            dd($blogs);
        return view('blogdisplay', compact('blogs'));
    }
}
