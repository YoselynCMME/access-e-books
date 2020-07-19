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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $books = auth()->user()->books;
        return view('home', compact('books'));
    }

    public function home_materials(){
        $books = auth()->user()->books;
        return view('materials.home', compact('books'));
    }

    public function get_reagent(){
        $url = 'http://127.0.0.1:8080/login';
        return redirect()->away($url);
    }
}
