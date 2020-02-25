<?php

namespace App\Http\Service;

use App\Constants;
use Illuminate\Support\Facades\Auth;
use App\Article;
use Illuminate\Http\Request;

class ArticleService
{
    public function __construct(Article $article)
    {
        $this->article = $article;
    }
    public function getArticle($request)
    {
        $per_page = $request->per_page ?? Constants::PER_PAGE;

        return Article::select('id', 'title', 'content', 'created_at')->where('user_id', '=', Auth::user()->id)
            ->latest()->paginate($per_page);
    }
    public function createArticle($request)
    {
        $request['user_id'] = Auth::user()->id;
        return $article = Article::create($request);
    }
    public function updateArticle($id, $input)
    {
        $article = $this->article->where('id', '=', $id);
        $article->update($input);
        return $article->get();
    }
    public function deleteArticle($id)
    {
        return $this->article->where('id', '=', $id)->delete();
    }
}
