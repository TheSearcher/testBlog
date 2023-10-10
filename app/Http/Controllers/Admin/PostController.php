<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Repositories\Interfaces\PostRepositoryInterface as Repo;
use Illuminate\Support\Facades\Log;

use App\Http\Requests\StorePostRequest;

use App\Http\Requests\UpdatePostRequest;

use App\Http\Controllers\Controller;

use App\Models\Post;

use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    private $repo;

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
        $datas = $this->repo->getPostData($request,null,true);

        return view('dashboard.admin.post.index', compact('datas'));
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $response = $this->repo->destroy($post);

        return back()->with($response['result'],$response['messages']);
    }
}
