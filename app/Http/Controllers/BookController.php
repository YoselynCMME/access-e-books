<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Spatie\Dropbox\Client;
use Carbon\Carbon;
use App\Book;

class BookController extends Controller
{

    // public function __construct()
    // {
    //     // Necesitamos obtener una instancia de la clase Client la cual tiene algunos métodos
    //     // que serán necesarios.
    //     $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();   
    // }


    // PROVIDERS
    public function show_level($level){
        $books = Book::where('category', $level)->get();
        return view('providers.level', compact('books'));
    }

    public function save_book(Request $request){
        $book = Book::whereCode($request->code)->first();

        if($book == null)
            return redirect('materials/home')->with('status', "El código es incorrecto");
        else {
            $search = \DB::table('book_user')->where(['book_id' => $book->id, 'user_id' => auth()->user()->id])->first();
            if( $search == null){
                auth()->user()->books()->attach($book->id);

                $reagent_book = \DB::connection('db_reagent_extern')->table('books')
                    ->where('name', 'like','%'.$book->level.'%')->first();
                $reagent_user = \DB::connection('db_reagent_extern')->table('users')
                    ->where('user_name', auth()->user()->user_name)->first();
                
                \DB::connection('db_reagent_extern')->table('accesos')->insert([
                    'user_id' => $reagent_user->id,
                    'book_id' => $reagent_book->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                return redirect('materials/home');
            } else {
                return redirect('materials/home')->with('status', "El código de libro ya se encuentra registrado");
            }
        }     
    }

    public function show($slug){
        $book = Book::whereSlug($slug)->with('pages')->first();
        return view('books.book', compact('book'));
    }

    public function show_category($category){
        $books = Book::where('category', $category)->get();
        return view('promociones.level', compact('books'));
    }

    public function show_type($type){
        if($type === 'english'){
            $data = [
                [
                    'category' => 'English Aware',
                    'type' => 'english-aware',
                    'number' => 2
                ], 
                [
                    'category' => 'Plus Factor',
                    'type' => 'plus-factor',
                    'number' => 5
                ]
            ];
        } else {
            // $data = [
            //     [
            //         'category' => 'Álgebra',
            //         'type' => 'algebra',
            //         'number' => 1
            //     ],
            //     [
            //         'category' => 'Biología',
            //         'type' => 'biologia',
            //         'number' => 1
            //     ],
            //     [
            //         'category' => 'Cálculo Diferencial',
            //         'type' => 'calculo',
            //         'number' => 1
            //     ], 
            //     [
            //         'category' => 'Ecología',
            //         'type' => 'ecologia',
            //         'number' => 1
            //     ], 
            //     [
            //         'category' => 'Física',
            //         'type' => 'fisica',
            //         'number' => 2
            //     ], 
            //     [
            //         'category' => 'Geometría y Trigonometría',
            //         'type' => 'geometria',
            //         'number' => 1
            //     ], 
            //     [
            //         'category' => 'LEO y E',
            //         'type' => 'lectura',
            //         'number' => 2 
            //     ], 
            //     [
            //         'category' => 'Química',
            //         'type' => 'quimica',
            //         'number' => 2
            //     ],
            //     [
            //         'category' => 'Geometría y Analítica',
            //         'type' => 'geometria-y-analitica',
            //         'number' => 1
            //     ], 
            //     [
            //         'category' => 'MAE de Química 1',
            //         'type' => 'mae-de-quimica-1',
            //         'number' => 1
            //     ],
            //     [
            //         'category' => 'MAE de Biología',
            //         'type' => 'mae-de-biologia',
            //         'number' => 2
            //     ], 
            // ];
            $data = [
                [
                    'category' => 'Álgebra',
                    'type' => 'algebra-pro-20-1',
                    'number' => 1
                ],
                [
                    'category' => 'Biología',
                    'type' => 'biologia-pro-20-2',
                    'number' => 1
                ],
                [
                    'category' => 'Cálculo Diferencial',
                    'type' => 'calculo-diferencial-pro-20-6',
                    'number' => 1
                ], 
                // [
                //     'category' => 'Ecología',
                //     'type' => 'ecologia',
                //     'number' => 1
                // ], 
                [
                    'category' => 'Física 2',
                    'type' => 'fisica-2-pro-20-4',
                    'number' => 1
                ], 
                // [
                //     'category' => 'Geometría y Trigonometría',
                //     'type' => 'geometria',
                //     'number' => 1
                // ], 
                [
                    'category' => 'LEO y E 1',
                    'type' => 'leo-y-e-1-pro-20-3',
                    'number' => 1 
                ], 
                [
                    'category' => 'Química 1',
                    'type' => 'quimica-1-pro-20-5',
                    'number' => 1
                ]
                // [
                //     'category' => 'Geometría y Analítica',
                //     'type' => 'geometria-y-analitica',
                //     'number' => 1
                // ], 
                // [
                //     'category' => 'MAE de Química 1',
                //     'type' => 'mae-de-quimica-1',
                //     'number' => 1
                // ],
                // [
                //     'category' => 'MAE de Biología',
                //     'type' => 'mae-de-biologia',
                //     'number' => 2
                // ], 
            ];
        }

        $collection = collect($data)->map(function ($name) {
            return collect($name);
        });
        $categories = $collection->sortBy('category');
        $categories->values()->all();
        return view('promociones.type', compact('categories', 'type'));
    }

    public function category($slug){
        // if($number === "1"){
        //     $book = Book::whereSlug($type)->with('pages')->first();
        //     return view('books.book', compact('book'));
        // } else {
        //     $books = Book::where('slug', 'like','%'.$type.'%')
        //                     ->where('category', 'promocion')
        //                     ->whereNotIn('id', [20, 21])->get();
        //     return view('promociones.category', compact('books', 'category'));
        // }

        if($slug === 'english' || $slug === 'comun'){
            $books = $this->books_promociones()->where('type', $slug)->all();
            return view('promociones.categories', compact('books', 'slug'));
        } else {
            $books = Book::where('slug', 'like','%'.$slug.'%')
                        ->where('category', 'promocion')->orderBy('book')->get();
            $b = $this->books_promociones()->where('slug', $slug)->first();

            return view('promociones.category', compact('books', 'b'));
        }
    }

    public function show_promociones($id, $slug){
        $book = Book::whereSlug($slug)->with('pages')->first();
        $b = $this->books_promociones()->where('slug', $slug)->first();
        
        // if($slug === 'menu') $book = $slug;

        // $categories = [
        //     [
        //         'id' => 1,
        //         'category' => 'English Aware',
        //         'type' => 'english-aware',
        //         'number' => 2
        //     ], 
        //     [
        //         'id' => 2,
        //         'category' => 'Plus Factor',
        //         'type' => 'plus-factor',
        //         'number' => 5
        //     ],
        //     [
        //         'id' => 3,
        //         'category' => 'Álgebra',
        //         'type' => 'algebra',
        //         'number' => 1
        //     ],
        //     [
        //         'id' => 4,
        //         'category' => 'Biología',
        //         'type' => 'biologia',
        //         'number' => 1
        //     ],
        //     [
        //         'id' => 5,
        //         'category' => 'Cálculo Diferencial',
        //         'type' => 'calculo',
        //         'number' => 1
        //     ], 
        //     [
        //         'id' => 6,
        //         'category' => 'Ecología',
        //         'type' => 'ecologia',
        //         'number' => 1
        //     ], 
        //     [
        //         'id' => 7,
        //         'category' => 'Física',
        //         'type' => 'fisica',
        //         'number' => 2
        //     ], 
        //     [
        //         'id' => 8,
        //         'category' => 'Geometría y Trigonometría',
        //         'type' => 'geometria',
        //         'number' => 1
        //     ], 
        //     [
        //         'id' => 9,
        //         'category' => 'LEO y E',
        //         'type' => 'lectura',
        //         'number' => 2 
        //     ], 
        //     [
        //         'id' => 10,
        //         'category' => 'Química',
        //         'type' => 'quimica',
        //         'number' => 2
        //     ],
        //     [
        //         'id' => 11,
        //         'category' => 'Geometría y Analítica',
        //         'type' => 'geometria-y-analitica',
        //         'number' => 1
        //     ], 
        //     [
        //         'id' => 12,
        //         'category' => 'MAE de Química 1',
        //         'type' => 'mae-de-quimica-1',
        //         'number' => 1
        //     ],
        //     [
        //         'id' => 13,
        //         'category' => 'MAE de Biología',
        //         'type' => 'mae-de-biologia',
        //         'number' => 2
        //     ]
        // ];

        // $collection = collect($categories)->map(function ($name) {
        //     return collect($name);
        // });
        
        // $category = $collection->where('id', $id)->first();

        // if($category['number'] > "1"){
        //     $books = Book::where('slug', 'like','%'.$category['type'].'%')
        //                     ->whereNotIn('id', [20, 21])->get();  
        // }   
        $b = $this->books_promociones()->where('id', $id)->first();

        return view('promociones.menu', compact('book', 'b'));
    }

    public function books_promociones(){
        $data = [
            [
                'id' => 1,
                'category' => 'English Aware',
                'type' => 'english',
                'slug' => 'english-aware',
                'number' => 3
            ], 
            [
                'id' => 2,
                'category' => 'Plus Factor',
                'type' => 'english',
                'slug' => 'plus-factor',
                'number' => 5
            ],
            [
                'id' => 3,
                'category' => 'Álgebra',
                'type' => 'comun',
                'slug' => 'algebra-pro-20-1',
                'number' => 1
            ],
            [
                'id' => 4,
                'category' => 'Biología',
                'type' => 'comun',
                'slug' => 'biologia-pro-20-2',
                'number' => 1
            ],
            [
                'id' => 5,
                'category' => 'Cálculo Diferencial',
                'type' => 'comun',
                'slug' => 'calculo-diferencial-pro-20-6',
                'number' => 1
            ], 
            [
                'id' => 6,
                'category' => 'Física',
                'type' => 'comun',
                'slug' => 'fisica',
                'number' => 2
            ],  
            [
                'id' => 7,
                'category' => 'LEO y E',
                'type' => 'comun',
                'slug' => 'leo-y-e',
                'number' => 2
            ], 
            [
                'id' => 8,
                'category' => 'Química',
                'type' => 'comun',
                'slug' => 'quimica',
                'number' => 2
            ],
            [
                'id' => 9,
                'category' => 'Geometría y Trigonometría',
                'type' => 'comun',
                'slug' => 'geometria-y-trigonometria-pro-20-18',
                'number' => 1
            ],
            [
                'id' => 10,
                'category' => 'Ecología',
                'type' => 'comun',
                'slug' => 'ecologia-pro-20-17',
                'number' => 1
            ],
            [
                'id' => 11,
                'category' => 'MAE de Biología 1',
                'type' => 'comun',
                'slug' => 'mae-de-b',
                'number' => 1
            ],
            [
                'id' => 12,
                'category' => 'MAE de Química 1',
                'type' => 'comun',
                'slug' => 'mae-de-q',
                'number' => 1
            ],
            [
                'id' => 13,
                'category' => 'Take Up English',
                'type' => 'english',
                'slug' => 'take-up-english',
                'number' => 1
            ],
            [
                'id' => 14,
                'category' => 'Horizontes O. Educativa',
                'type' => 'comun',
                'slug' => 'horizontes',
                'number' => 2
            ],
            [
                'id' => 15,
                'category' => 'Best Of English',
                'type' => 'p-english',
                'slug' => 'p-e-boe',
                'number' => 1
            ],
            [
                'id' => 16,
                'category' => 'Building up',
                'type' => 'p-english',
                'slug' => 'p-e-bu',
                'number' => 1
            ],
            [
                'id' => 17,
                'category' => 'English Aware',
                'type' => 'p-english',
                'slug' => 'p-e-ea',
                'number' => 3
            ], 
            [
                'id' => 18,
                'category' => 'Let´s Do It',
                'type' => 'p-english',
                'slug' => 'p-e-ldi',
                'number' => 1
            ],
            [
                'id' => 19,
                'category' => 'Plus Factor',
                'type' => 'p-english',
                'slug' => 'p-e-pf',
                'number' => 5
            ],
            [
                'id' => 20,
                'category' => 'Take Up English',
                'type' => 'p-english',
                'slug' => 'p-e-tue',
                'number' => 1
            ],
        ];

        $collection = collect($data)->map(function ($name) {
            return collect($name);
        });

        return $collection;
    }



    // INDIVIDUAL
    public function book_individual($slug){
        $book = Book::whereSlug($slug)->with('pages')->first();
        return view('promociones.individual.book', compact('book'));
    }

    // TODO O SEPARADO
    public function show_categories($todo, $slug){
        // // dd(Storage::disk('dropbox')->files('/'));
        // // $imgprueba = Storage::disk('dropbox')->get('1.jpg');
        // $imgprueba = Storage::disk('dropbox')->temporaryUrl('reducida.jpg', now()->addMinutes(1));
        // // dd($imgprueba);
        // return view('home', compact('imgprueba'));
        // // PROYECTOS-MAJESTIC/EBOOK/ESPAÑOL/ÁLGEBRA/1.jpg

        $books = $this->books_promociones()->where('type', $slug)->all();

        if($todo === '1') $url = 'promociones.menu.categories';
        if($todo === '2') $url = 'promociones.categories.categories';

        return view($url, compact('books', 'slug'));
    }

    public function type_category($todo, $slug){
        $books = Book::where('slug', 'like','%'.$slug.'%')
                    ->where('category', 'promocion')->orderBy('book')->get();
        $b = $this->books_promociones()->where('slug', $slug)->first();
        
        if($todo === '0') $url = 'promociones.category.category';
        if($todo === '1') $url = 'promociones.menu.category';
        if($todo === '2') $url = 'promociones.categories.category';
        
        return view($url, compact('books', 'b'));

    }

    public function book_category($todo, $id, $slug){
        $book = Book::whereSlug($slug)->with('pages')->first();
        $b = $this->books_promociones()->where('id', $id)->first();

        if($todo === '0') $url = 'promociones.category.book';
        if($todo === '1') $url = 'promociones.menu.book';
        if($todo === '2') $url = 'promociones.categories.book';

        return view($url, compact('book', 'b'));
    }

    public function book_pres($slug){
        $book = Book::whereSlug($slug)->with('pages')->first();
        return view('presentacion.book', compact('book'));
    }

    public function menu_english(){
        $books = $this->books_promociones()->where('type', 'p-english')->all();
        return view('presentacion.english.menu', compact('books'));
    }

    public function get_extra($id){
        $book = Book::find($id);
        $link_lessons = $book->link_lessons;
        return view('materials.extra', compact('link_lessons'));
    }

}
