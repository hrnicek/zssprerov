<?php

namespace App\Http\Controllers;

use App\Models\Faq;

class ConsumersController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order_column')
            ->select('id', 'question', 'answer', 'is_open')
            ->get();

        return inertia('Consumers', [
            'faqs' => $faqs,
        ]);
    }
}
