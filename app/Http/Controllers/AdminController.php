<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;

class AdminController extends Controller
{
    public function index(){
        $books = Book::all();
        return view('administrator.home', compact('books'));
    }

    public function users(){
        $users = User::all();
        return view('administrator.users', compact('users'));
    }
}
