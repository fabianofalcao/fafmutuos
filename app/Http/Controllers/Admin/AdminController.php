<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function home()
    {
        if(!auth()->check()){
            return redirect()->route('login');
        }
        $breadcrumb = [
            (object) ['url' => '', 'title' => 'Home',],
        ];
        return view('admin.home.index', compact('breadcrumb'));
    }
}
