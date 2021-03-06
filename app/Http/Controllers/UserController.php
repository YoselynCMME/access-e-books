<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Book;

class UserController extends Controller
{
    public function update(Request $request){
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'school' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'min:5', 'max:15', 'alpha_num'],
            'email' => ['required', 'string', 'email', 'max:255']
        ]);
        $user = User::whereId($request->id)->first();
        $user->update($request->all());
        return response()->json($user);
    }

    public function delete(){
        $user_id = Input::get('user_id');
        User::whereId($user_id)->delete();
        return response()->json();
    }

    public function books(){
        $user_id = Input::get('user_id');
        $user = User::whereId($user_id)->with('books')->first();
        return response()->json($user);
    }

    public function delete_book(){
        $user_id = Input::get('user_id');
        $book_id = Input::get('book_id');

        $user = User::whereId($user_id)->first();
        $user->books()->detach($book_id);
        return response()->json();
    }

    public function save_book(Request $request){
        $book = Book::whereCode($request->code)->first();
        $user = User::whereId($request->user_id)->first();
        
        if($book == null)
            return response()->json("El código es incorrecto");
        else {
            $search = \DB::table('book_user')->where(['book_id' => $book->id, 'user_id' => $user->id])->first();
            
            if( $search == null){
                $user->books()->attach($book->id);

                if($user->role_id === 3){
                    if($book->category === 'english'){
                        $reagent_book = $this->queryBook($book->level);
                    } else {
                        $b = strpos($book->book, 'BIOLOGIA 1');
                        $q = strpos($book->book, 'QUIMICA 1');
                        
                        if($b === false) $reagent_book = $this->queryBook($book->book);
                        if($q === false) $reagent_book = $this->queryBook($book->book);
                        if($b === 9) $reagent_book = $this->queryBook('BIOLOGIA 1');
                        if($q === 9) $reagent_book = $this->queryBook('QUIMICA 1');
                    }

                    $reagent_user = \DB::connection('db_reagent_extern')->table('users')
                        ->where('user_name', $user->user_name)->first();
                    
                    if($reagent_book !== null){
                        $buscar = \DB::connection('db_reagent_extern')->table('accesos')
                            ->where('user_id', $reagent_user->id)
                            ->where('book_id', $reagent_book->id)->first();
                        
                        if($buscar === null){
                            \DB::connection('db_reagent_extern')->table('accesos')->insert([
                                'user_id' => $reagent_user->id,
                                'book_id' => $reagent_book->id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]); 
                        }
                    }
                }
                return response()->json("El libro se guardo");
            } else {
                return response()->json("El código de libro ya se encuentra registrado");
            }
        }
    }

    public function queryBook($book){
        return \DB::connection('db_reagent_extern')->table('books')
                                ->where('name', 'like','%'.$book.'%')->first();
    }
}
