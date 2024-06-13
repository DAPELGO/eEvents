<?php

namespace App\Http\Controllers\admin;

use App\Models\user\Article;
use App\Models\user\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{


     public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->can('articles.view')) {
            $articles = DB::table('articles')
                                ->join('categories', 'categories.id', 'articles.categorie_id')
                                ->select('articles.*', 'categories.titre as categorie')
                                ->where('articles.is_delete', 0)
                                ->get();

            return view('backend.articles.index', compact('articles'));
        }
        return redirect(route('backend.home'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('articles.create')) {
            $categories = Categorie::where('is_delete', 0)->get();
            return view('backend.articles.create', compact('categories'));
        }
        return redirect(route('backend.home'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('articles.create')) {
            $this->validate($request, [

                    'titre'=>'required',
                    ]);

                    $file_urls = '';
                    if($request->hasFile('file_urls')) {
                        $file_urls = $request->file_urls->store('public/profile/user');
                    }
            $va= Article::create([
                    'categorie_id'=>$request->id_categorie,
                    'titre'=>$request->titre,
                    'soustitre'=>$request->soustitre,
                    'chapeau'=>$request->chapeau,
                    'corps'=>$request->corps,
                    'is_delete'=>0,
                    'file_urls'=>$file_urls,
                ]);

            return redirect()->route('articles.index');
        }
        return redirect(route('backend.home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        if (Auth::user()->can('articles.view')) {
            $articles = DB::table('articles')
                                ->join('categories', 'categories.id', 'articles.categorie_id')
                                ->select('articles.*', 'categories.titre as categorie')
                                ->where('articles.is_delete', 0)
                                ->where('articles.id', $id)
                                ->get();
            return view('backend.articles.show', compact('articles'));
        }
        return redirect(route('backend.home'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        if (Auth::user()->can('articles.update')) {
            $article = Article::where('id',  $id)->first();
            $categories = Categorie::where('is_delete', 0)->get();
            return view('backend.articles.edit', compact('article', 'categories'));
        }
        return redirect(route('backend.home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        if (Auth::user()->can('articles.update')) {
        $this->validate($request, [

                'titre'=>'required',
            ]);

            $article = Article::where('id', $id)->first();

            $file_urls = '';
                 if($request->hasFile('file_urls')) {
                     $file_urls = $request->file_urls->store('public/profile/user');
                 }
            $article->update([
                'categorie_id'=>$request->id_categorie,
                'titre'=>$request->titre,
                'soustitre'=>$request->soustitre,
                'chapeau'=>$request->chapeau,
                'corps'=>$request->corps,
                'file_urls'=>$file_urls,
            ]);

            return redirect()->route('articles.index');
        }
        return redirect(route('backend.home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }

    public function delete(Request $request)
    {


            $id = $request->id;
            $article = Article::findOrFail($id);
            $article->update([
                'is_delete' => 1,
            ]);

    }
}
