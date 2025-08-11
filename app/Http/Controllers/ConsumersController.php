<?php

namespace App\Http\Controllers;

class ConsumersController extends Controller
{
    public function index()
    {
        return inertia('Consumers');
    }
}
