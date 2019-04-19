<?php

namespace App\Http\Controllers;

use App\Article;
use App\User;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with(['category', 'user'])->simplePaginate(15);
        return view("article.index", ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("article.create", ["categories" => $categories]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:50|min:2|string',
            'content' => 'required|max:255|min:5|string',
            'picture' => 'starts_with:https://|min:15|max:255|string|required',
            'price' => '|max:1000000000|numeric|required',
        ]);

        $article = new Article();

        $article->title = $request->title;
        $article->content = $request->content;
        $article->picture = $request->picture;
        $article->price = $request->price;
        $article->category()->associate($request->category);
        $article->user()->associate(Auth::user());

        $article->save();

        return redirect()->route('article.show', ['id' => $article->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view("article.show", ['article' => $article]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        if ($article->user->id != Auth::id()){
            abort(403);
        }
        $categories = Category::all();
        return view("article.edit", ["article" => $article, "categories" => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        if ($article->user->id != Auth::id()){
            abort(403);
        }
        $request->validate([
            'title' => 'required|max:50|min:2|string',
            'content' => 'required|max:255|min:5|string',
            'picture' => 'starts_with:https://|min:15|max:255|string|required',
            'price' => '|max:1000000000|numeric|required',
        ]);

        $article->title = $request->title;
        $article->content = $request->content;
        $article->picture = $request->picture;
        $article->price = $request->price;
        $article->category()->associate($request->category);
        $article->save();
        return redirect()->route('article.show', ['id' => $article->id]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if ($article->user->id != Auth::id()){
            abort(403);
        }
        $article->delete();
        return redirect()->route('article.index')->with('success', 'The article has been deleted');
    }
}
