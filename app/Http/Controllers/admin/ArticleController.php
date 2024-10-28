<?php

namespace App\Http\Controllers\admin;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\admin\Article;
use App\Models\admin\Categorie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        if (!Auth::user()->can('articles.view')) {
            flash()->addError("Vous n'avez pas l'autorisation d'accéder à cette page");
            return redirect()->route('backend.home');
        }

        $articles = Article::where('is_delete', FALSE)
                                ->select('id', 'titre', 'slug', 'id_categorie', 'date_article', 'is_published', 'id_user_created')
                                ->with('categorie', 'user_created')
                                ->get();

        return view('backend.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->can('articles.create')) {
            flash()->addError("Vous n'avez pas l'autorisation d'accéder à cette page");
            return redirect()->route('backend.home');
        }

        $categories = Categorie::where('is_delete', FALSE)
                                ->where('type_categories', 'articles')
                                ->get();

        return view('backend.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::user()->can('articles.create')) {
            flash()->addError("Vous n'avez pas l'autorisation d'accéder à cette page");
            return redirect()->route('backend.home');
        }

        $this->validate($request, [
            'titre'=>'required',
            'categorie'=>'required|exists:categories,id'
        ]);

        //verify if slug exist
        $slug = Article::where('slug', Str::slug($request->titre))->first();

        if ($slug) {
            flash()->addError('Cet article existe déjà');
            return redirect()->back();
        }

        $status = $request->status == '1' ? true : false;

        try {
            if($request->file('image')){
                $image = $request->file('image');

                // check image extension
                $allowedfileExtension=['jpg','png','jpeg'];
                $extension = $image->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);

                if(!$check){
                    flash()->addError('Le fichier doit être une image de type jpg, jpeg ou png');
                    return redirect()->back();
                }

                //check image size
                $size = $image->getSize();
                if($size > 5000000){
                    flash()->addError('La taille de l\'image ne doit pas dépasser 5Mo');
                    return redirect()->back();
                }

                //check image dimension
                $dimensions = getimagesize($image);
                if($dimensions[0] < 1920 || $dimensions[1] < 1080){
                    flash()->addError('Les dimensions de l\'image ne doivent pas dépasser 1920x1080');
                    return redirect()->back();
                }

                $image_name = Str::slug($request->titre , "_").'_'.$request->date_article.'.'.$extension;
                $image->move(public_path('images/articles/cover'), $image_name);
            }
            else{
                $image_name = 'default_article.png';
            }
        }
        catch (Exception $e) {
            $image_name = 'default_article.png';
        }

        try{
            Article::create([
                'titre'=>$request->titre,
                'slug'=>Str::slug($request->titre),
                'id_categorie'=>$request->categorie,
                'url_img'=>$image_name,
                'date_article'=>$request->date_article,
                'content'=>$request->contenu,
                'is_published'=>$status,
                'id_user_created'=>Auth::user()->id
            ]);
        }
        catch(Exception $e){
            Log::error('Erreur lors de l\'enregistrement de l\'article: '.$e->getMessage());
            flash()->addError('Erreur lors de l\'enregistrement de l\'article');
        }

        flash()->addSuccess('Article enregistré avec succès');
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Auth::user()->can('articles.view')) {
            flash()->addError("Vous n'avez pas l'autorisation d'accéder à cette page");
            return redirect()->route('backend.home');
        }

         $article = Article::where('id', $id)
                            ->with('categorie', 'user_created')
                            ->first();

        if(!$article){
            flash()->addError('Article non trouvé');
            return redirect()->route('articles.index');
        }

        return view('backend.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        if (!Auth::user()->can('articles.update')) {
            flash()->addError("Vous n'avez pas l'autorisation d'accéder à cette page");
            return redirect()->route('backend.home');
        }

        $article = Article::where('id', $id)->first();

        if(!$article){
            flash()->addError('Article introuvable');
            return redirect()->route('articles.index');
        }

        $categories = Categorie::where('is_delete', FALSE)
                                ->where('type_categories', 'articles')
                                ->get();

        return view('backend.articles.edit', compact('article', 'categories'));
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
        if (!Auth::user()->can('articles.update')) {
            flash()->addError("Vous n'avez pas l'autorisation d'accéder à cette page");
            return redirect()->route('backend.home');
        }

        $this->validate($request, [
            'titre'=>'required',
            'categorie'=>'required|exists:categories,id'
        ]);

        $article = Article::where('id', $id)->first();

        if(!$article){
            flash()->addError('Article introuvable');
            return redirect()->route('articles.index');
        }

        $slug = Article::where('slug', Str::slug($request->titre))
                        ->where('id', '!=', $id)
                        ->first();

        if ($slug) {
            flash()->addError('Cet article existe déjà');
            return redirect()->back();
        }

        $status = $request->status == '1' ? true : false;

        try {
            if($request->file('image')){
                $image = $request->file('image');

                // check image extension
                $allowedfileExtension=['jpg','png','jpeg'];
                $extension = $image->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);

                if(!$check){
                    flash()->addError('Le fichier doit être une image de type jpg, jpeg ou png');
                    return redirect()->back();
                }

                //check image size
                $size = $image->getSize();
                if($size > 5000000){
                    flash()->addError('La taille de l\'image ne doit pas dépasser 5Mo');
                    return redirect()->back();
                }

                //check image dimension
                $dimensions = getimagesize($image);
                if($dimensions[0] < 1920 || $dimensions[1] < 1080){
                    flash()->addError('Les dimensions de l\'image ne doivent pas dépasser 1920x1080');
                    return redirect()->back();
                }

                $image_name = Str::slug($request->titre , "_").'_'.$request->date_article.'.'.$extension;
                $image->move(public_path('images/articles/cover'), $image_name);
            }
            else{
                $image_name = $article->url_img;
            }
        }
        catch (Exception $e) {
            $image_name = $article->url_img;
        }

        try{
            $article->update([
                'titre'=>$request->titre,
                'slug'=>Str::slug($request->titre),
                'id_categorie'=>$request->categorie,
                'url_img'=>$image_name,
                'date_article'=>$request->date_article,
                'content'=>$request->contenu,
                'is_published'=>$status,
                'id_user_modified'=>Auth::user()->id
            ]);
        }
        catch(Exception $e){
            Log::error('Erreur lors de la modification de l\'article: '.$e->getMessage());
            flash()->addError('Erreur lors de la modification de l\'article');
        }

        flash()->addSuccess('Article modifié avec succès');
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        return redirect()->route('articles.index');
    }

    public function delete($id)
    {
        if (!Auth::user()->can('articles.delete')) {
            flash()->addError("Vous n'avez pas l'autorisation d'accéder à cette page");
            return redirect()->route('backend.home');
        }

        try{
            $article = Article::where('id', $id)->first();

            if(!$article){
                flash()->addError('Article introuvable');
                return redirect()->route('articles.index');
            }

            $article->update([
                'is_delete'=>TRUE,
                'id_user_delete'=>Auth::user()->id
            ]);
        }
        catch(Exception $e){
            Log::error('Erreur lors de la suppression de l\'article: '.$e->getMessage());
            flash()->addError('Erreur lors de la suppression de l\'article');
        }

        flash()->addSuccess('Article supprimé avec succès');
        return redirect()->route('articles.index');
    }

    public function showArticle($slug)
    {
        $article = Article::where('slug', $slug)->first();
        return view('frontend.article', compact('article'));
    }
}
