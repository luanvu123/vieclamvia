<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $gradients = [
            'linear-gradient(to right, #FF5F6D, #FFC371)',
            'linear-gradient(to right, #2193b0, #6dd5ed)',
            'linear-gradient(to right, #cc2b5e, #753a88)',
            'linear-gradient(to right, #00d2ff, #3a7bd5)',
            'linear-gradient(to right, #ee9ca7, #ffdde1)',
            'linear-gradient(to right, #FF6B6B, #F0E68C)'
        ];

        // Lấy các Category, Subcategory và Product kích hoạt (status = 1)
        $categories = Category::where('status', 1)
            ->with(['subcategories' => function($query) {
                $query->where('status', 1)
                    ->with(['products' => function($query) {
                        $query->where('status', 1);
                    }]);
            }])
            ->get();

        return view('pages.home', compact('categories', 'gradients'));
    }
}
