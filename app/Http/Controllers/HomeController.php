<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

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
        if(auth()->user()->role_id === 2){
            $accesos = auth()->user()->books;
            $bs = array();
            foreach($accesos as $acceso){
                $b = $acceso;
                $b->link_games = str_replace('teacher', 'student', $b->link_games);
                array_push($bs, $b);
            }
            $collection = collect($bs)->map(function ($name) {
                return collect($name);
            });
            $books = $collection->sortBy('book');
            $books->values()->all();
        }
        if(auth()->user()->role_id === 3){
            $accesos = auth()->user()->books;

            $data = array();
            foreach ($accesos as $acceso) {
                $b = Book::where('book', 'like','%'.$acceso->book.'%')
                    ->where('book', '!=', $acceso->book)->first();
                $package = [
                    'student' => $acceso,
                    'teacher' => $b
                ];
                array_push($data, $package);
            }

            $collection = collect($data)->map(function ($name) {
                return collect($name);
            });
            $books = $collection->sortBy('student');
            $books->values()->all();
        }
        return view('materials.home', compact('books'));
    }
}
