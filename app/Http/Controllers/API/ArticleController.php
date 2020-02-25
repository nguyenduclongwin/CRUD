<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use App\Article;
use App\Exports\ArticlesExport;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Validator;
use App\Http\Service\ArticleService;
use App\Http\Service\EmailService;
use App\Http\Service\UserService;
use App\Jobs\SendArticleEmail;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notification;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Illuminate\Support\Facades\Storage;

class ArticleController extends BaseController
{
    public function __construct(ArticleService $service, UserService $user_service)
    {
        $this->service = $service;
        $this->user_service = $user_service;
    }
    public function index(Request $request)
    {
        $article = $this->service->getArticle($request);
        return $this->sendResponse($article, 'Retrieve Successfully');
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required|unique:articles',
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('validator error', $validator->errors());
        }
        $article = $this->service->createArticle($input);
        $friend_user = $this->user_service->getFriendUser();
        $user = $this->user_service->getUser();
        $this->dispatch(new SendArticleEmail($friend_user, $user));
        return $this->sendResponse($article, 'Successfully');
    }
    public function show(Article $article)
    {
        return $this->sendResponse($article, 'Successfully');
    }
    public function update(Request $request, $article)
    {
        $input = $request->only('title', 'content');
        $validator = Validator::make($input, [
            'title' => 'required',
            'content' => 'required'
        ]);
        if ($validator->fails()) {
            return $this->sendError('validator error', $validator->errors());
        }
        $result = $this->service->updateArticle($article, $input);
        return $this->sendResponse($result, 'Successfully');
    }
    public function destroy($article)
    {
        $result = $this->service->deleteArticle($article);
        return $this->sendResponse($result, 'Successfully');
    }
    public function export(Request $request)
    {
        $article = $this->service->getArticle($request);
        Excel::store(new ArticlesExport($article), 'article_page' . $request->page . '.xlsx');
        return $this->sendResponse(['url' => Storage::url('article_page' . $request->page . '.xlsx')], 'success');
    }
}
