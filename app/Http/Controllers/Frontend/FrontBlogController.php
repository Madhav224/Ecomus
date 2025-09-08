<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Blog;

class FrontBlogController extends Controller
{
     public function index()
    {
        // Get active blogs with pagination
        $blogs = Blog::where('status', 'active')
            ->latest()
            ->paginate(9);

        return view('frontend.blog', compact('blogs'));
    }
}
