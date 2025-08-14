<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Establishment;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $establishments = Establishment::get();

        return inertia('Welcome', [
            'establishments' => $establishments,
            'posts' => Post::active()->latest('published_at')->with('media')->limit(3)->get(),
            'documents' => Document::active()->ordered()->with('media')->get(),
        ]);
    }
}
