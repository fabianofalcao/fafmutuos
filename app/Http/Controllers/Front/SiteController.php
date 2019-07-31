<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index()
    {
        return view('front.home.index');
    }

    public function emprestimo()
    {
        return view('front.home.emprestimo');
    }
}
