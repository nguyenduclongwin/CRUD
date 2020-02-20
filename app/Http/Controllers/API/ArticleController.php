<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;

class ArticleController extends BaseController
{
    public function index()
    {
        $article = Article::where('user_id', '=', Auth::user()->id)->latest()->get();
        return $this->sendResponse($article->toArray(), 'Retrieve Successfully');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:articles',
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('validator error', $validator->errors());
        }
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $article = Article::create($input);
        return $this->sendResponse($article->toArray(), 'Successfully');
    }

    public function show(Article $article)
    {
        return $this->sendResponse($article->toArray(), 'Successfully');
    }

    public function update(Request $request, Article $article)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:articles',
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('validator error', $validator->errors());
        }
        $article->title = request("title");
        $article->content = request("content");
        $article->save();
        return $this->sendResponse($article->toArray(), 'Successfully');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return $this->sendResponse($article->toArray(), 'Successfully');
    }
}
