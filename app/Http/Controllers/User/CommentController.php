<?php

namespace App\Http\Controllers\User;

use App\Models\Comment;
use App\Repositories\Interfaces\PostRepositoryInterface as Repo;
use Illuminate\Http\Request;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


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
        $datas = $this->repo->getCommentsData($request,$this->getUserId(),null);

        return view('dashboard.auth-user.comment.index', compact('datas'));
    }

    /**
     * @param StoreCommentRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();

        $response = $this->repo->saveData($data,'comments');

        return back()->with($response['result'],$response['messages']);
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|never
     */
    public function edit(Comment $comment)
    {
        if ((!$comment->id) || ($this->getUserId() !== $comment->user_id)) {
            return abort(404, 'Unauthorized action.');
        }

        return view('dashboard.auth-user.comment.edit_comment', compact('comment'));
    }

    /**
     * @param UpdateCommentRequest $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse|never
     */
    public function update(UpdateCommentRequest $request, string $id)
    {
        $data = $request->validated();

        if ((!isset($data['id'])) || ($this->getUserId() !== $data['user_id'])) {
            return abort(404, 'Unauthorized action.');
        }

        $response =  $this->repo->updateData($data,'comments', $data['id']);

        return back()->with($response['result'],$response['messages']);
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\RedirectResponse|never
     */
    public function destroy(Comment $comment)
    {
        if (Auth::user()->id !== $comment->user_id) {
            return abort(403, 'Unauthorized action.');
        }

        $response = $this->repo->destroy($comment);

        return back()->with($response['result'],$response['messages']);
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return Auth::user()->id;
    }
}
