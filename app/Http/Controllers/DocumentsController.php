<?php

namespace App\Http\Controllers;

class DocumentsController extends Controller
{
    public function index()
    {
        return inertia('Documents');
    }
}
