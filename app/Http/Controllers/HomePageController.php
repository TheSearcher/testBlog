<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Interfaces\PostRepositoryInterface as Repo;
use Illuminate\Support\Facades\Auth;

use Hash;
use Session;

use Illuminate\Support\Facades\Input;
use Validator;

use App\Http\Requests\SearchRequest;

use App\Models\User;

class HomePageController extends Controller
{
    private $repo;

    private $search = [];

    /**
     * Creating a new constructor for the project Controller
     */
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    public function index(SearchRequest $request)
    {
        $data = $request->validated();

        $datas = $this->repo->getPostData($data, null,true);

        return view('posts', compact('datas'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show(Request $request)
    {
        $id = (int) $request->post;

        $data = $this->repo->getPost($id);

        return view('post_view', compact('data'));
    }

    public function logsOut()
    {
        Session::flush();

        Auth::logout();

        return Redirect('login');
    }
}
