<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CategoryArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $article = new Article();
        $article['title'] = $request->title;
        $article['category_id'] = $request->category_id;
        $article['body'] = $request->body;
        $article['excerpt'] = Str::substr($request->body, 0, 100);
        $article['slug'] = Str::slug($request->title);
        $article['user_id'] = Auth::user()->id;
        $article['active'] = $request->active;
        if ($request->image == null) {
            $article['image'] = "https://images.unsplash.com/photo-1499750310107-5fef28a66643?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80";
        } else {
            $article['image'] = $request->image;
        }
        
        $article->save();

        return redirect()->to('/admin/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {

        return view('articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = CategoryArticle::all();
        return view('admin.edit-article', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        // dd($request);
        $article->title = $request['title'];
        $article->body = $request['body'];
        $article['excerpt'] = Str::substr($request->body, 0, 100);
        if ($request['category_id'] != "Choisir une catégorie") {
            $article->category_id = $request['category_id'];
        }
        $article['active'] = $request->active;
        $article->save();

        return redirect()->to('/admin/articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $article = Article::find($id);
        // dd($article);
        $article->delete();

        return back();
    }
}
