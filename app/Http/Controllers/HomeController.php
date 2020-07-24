<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('admin.menu.index');
        // return view('home');
    }

    public function input()
    {
        return redirect()->route('admin.menu.index');
        // return view('admin.input');
    }

    public function menu()
    {
        return view('admin.menu');
    }

    public function menucreate()
    {
        return view('admin.menuform');
    }

    public function category()
    {
        return view('admin.category');
    }

    public function categorycreate()
    {
        return view('admin.categorycreate');
    }

    public function post()
    {
        return view('admin.post');
    }

    public function pages()
    {
        return view('admin.pages');
    }
}
