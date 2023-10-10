<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Repositories\Interfaces\PostRepositoryInterface as Repo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Http\Requests\StorePostRequest;

use App\Http\Requests\UpdatePostRequest;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
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
        $datas = $this->repo->getPostData($request, $this->getUserId(),null);

        return view('dashboard.auth-user.post.index', compact('datas'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        return view('dashboard.auth-user.post.view');
    }

    /**
     * @param StorePostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $response = $this->repo->saveData($data,'posts');

        return back()->with($response['result'],$response['messages']);
    }

    /**
     * @param UpdatePostRequest $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse|never
     */
    public function update(UpdatePostRequest $request, string $id)
    {
        $data = $request->validated();

        if ((!isset($data['id'])) || ($this->getUserId() !== $data['user_id'])) {
            return abort(404, 'Unauthorized action.');
        }

        $response = $this->repo->updateData($data,'posts', $data['id']);

        return back()->with($response['result'],$response['messages']);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|never
     */
    public function edit(Post $post)
    {
        if ((!$post->id) || ($this->getUserId() !== $post->user_id)) {
            return abort(404, 'Unauthorized action.');
        }

        return view('dashboard.auth-user.post.view', compact('post'));
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse|never
     */
    public function destroy(Post $post)
    {
        if ($this->getUserId() !== $post->user_id) {
            return abort(403, 'Unauthorized action.');
        }

        $response = $this->repo->destroy($post);

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
