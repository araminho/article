<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = null;
        if ($request->has('search')) {
            $search = $request->input('search');
            $articles = Article::where('title', 'like', "%$search%")->get();
        } else {
            $articles = Article::all();
        }
        return view('articles.index', compact('articles', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);
        $article = new Article();
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->user_id = Auth::user()->id;
        $article->save();
        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $article = Article::find($id);
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);
        $article = Article::find($id);
        if ($article->user_id != Auth::user()->id) {
            return redirect()->back()->withErrors(['msg' => "You can edit only your articles"]);
        }
        $article->title = $request->input('title');
        $article->content = $request->input('content');
        $article->save();
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $article = Article::find($id);
        if ($article->user_id != Auth::user()->id) {
            return redirect()->back()->withErrors(['msg' => "You can delete only your articles"]);
        }

        $article->delete();
        return redirect()->route('articles.index');
    }
}
