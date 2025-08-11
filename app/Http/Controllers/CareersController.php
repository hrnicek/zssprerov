<?php

namespace App\Http\Controllers;

class CareersController extends Controller
{
    public function index()
    {
        return inertia('careers/Index');
    }

    public function show($id)
    {
        return inertia('careers/Show', [
            'id' => $id,
        ]);
    }
}
