<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Interfaces\PostRepositoryInterface as Repo;
use Illuminate\Http\Request;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

use App\Http\Controllers\Controller;

use App\Models\Comment;

class CommentController extends Controller
{
    private $repo;

    /**
     * @param Repo $repo
     */
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        $datas = $this->repo->getCommentsData($request,null,null);

        return view('dashboard.admin.comment.index', compact('datas'));
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment)
    {
        $response = $this->repo->destroy($comment);

        return back()->with($response['result'],$response['messages']);
    }
}
