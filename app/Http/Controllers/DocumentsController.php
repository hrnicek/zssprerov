<?php

namespace App\Http\Controllers;

use App\Models\Document;

class DocumentsController extends Controller
{
    public function index()
    {
        $documents = Document::active()->ordered()->with('media')->get();

        return inertia('documents/Index', [
            'documents' => $documents,
        ]);
    }
}
