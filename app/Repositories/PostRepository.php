<?php

namespace App\Repositories;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;


class PostRepository implements PostRepositoryInterface
{
    private const SUCCESS_DATA_DELETED   = "Data Was Successfully Deleted";

    private const ERROR_DATA_NOT_DELETED = "Unable To Delete Data Now, Please Try Again Later";

    private const SUCCESS_DATA_SAVED = "Data Was Successfully Saved";

    private const ERROR_DATA_NOT_SAVED = "Unable To save Data Now, Please Try Again Later";


    public function __construct()
    {
    }

    /**
     * @param $user_id
     * @param $users
     * @param $request
     * @return mixed
     */
    public function getCommentsData($request, $user_id=null, $users=null)
    {
        return Comment::select('id as comment_id','post_id','body','created_at','user_id as author_id')
               ->with(['post' => function (Builder $q) {
                $q->select(['id','title','user_id']);
                   $q->with(['user' => function ($q) {
                       $q->select('id','name','profile_photo_path');
                   } ]);
               }])
              ->when($user_id, function (Builder $q) use ($user_id)  {
                $q->where('user_id', $user_id);
              })
             ->orderBy('id', 'desc')
              ->paginate(15);
    }

    /**
     * @param $user_id
     * @param $users
     * @param $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPostNotfications()
    {
        return Post::select('id as post_id','title','created_at','user_id')
            ->with(['user' => function (Builder $q) {
                $q->select(['id','name','profile_photo_path']);
            }])
            ->where('email_sent', '!=', 1)
            ->withCount('comments')
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();
    }

    /**
     * @param $user_id
     * @param $users
     * @param $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPostData($request, $user_id=null, $users=null): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $title = (isset($request['title'])) ? ($request['title']) : null;
        $body  = (isset($request['body'])) ? ($request['body']) : null;

        return Post::query()->select('id as post_id','title','body','created_at','user_id')
                ->when($users, function ($q)  {
                    $q->with(['user' => function (Builder $q) {
                        $q->select(['id','name','profile_photo_path']);
                    }]);
                })
                ->when($user_id, function (Builder $q) use ($user_id)  {
                    $q->where('user_id', $user_id);
                })
                ->withCount('comments')
                ->when($title, function (Builder $query) use ($title) {
                    $query->orWhere('title', 'like', '%'.$title.'%');
                 })
                ->when($body, function ($query) use ($body) {
                    $query->orWhere('body', 'like', '%'.$body.'%');
                })
                ->orderBy('id', 'desc')
                ->paginate(15);
    }

    /**
     * @return void
     */
    public function bulkPostEmailUpdate()
    {
        Post::where('email_sent', '!=', 1)->update(['email_sent' => 1]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getPost($id)
    {
        return  Post::select('id','title','body','created_at')
                ->where('id',$id)
                ->with(['comments'=> function (Builder $q) {
                    $q->select(['id','post_id','user_id','body','created_at']);
                    $q->with(['user' => function (Builder $q) {
                        $q->select(['id','name','profile_photo_path']);
                    }]);
                }])
                ->first();
    }

    /**
     * @param $data
     * @param $method
     * @param $id
     * @return array
     */
    public function updateData($data, $method, $id)
    {
        $result = $this->getUser()->$method()->where('id', $id)->update($data);

        return $this->responseMessage($result,self::SUCCESS_DATA_SAVED,self::ERROR_DATA_NOT_SAVED);
    }

    /**
     * @param $data
     * @param $method
     * @return array
     */
    public function saveData($data, $method)
    {
        $result = $this->getUser()->$method()->create($data);

        return $this->responseMessage($result,self::SUCCESS_DATA_SAVED,self::ERROR_DATA_NOT_SAVED);
    }

    public function responseMessage($result,$sucess,$error)
    {
        return ($result) ?
            (['result' =>"success", 'messages'=> $sucess]) :
            (['result' =>"error",   'messages'=> $error]);
    }

    /**
     * @param $id
     * @return array|void
     */
    public function destroy($data)
    {
        try {
            $result = $data->delete();

            return $this->responseMessage($result,self::SUCCESS_DATA_DELETED,self::ERROR_DATA_NOT_DELETED);

        }catch(\Exception $e) {
            Log::info('Error Message', ['user' => Auth::user()->id,  __METHOD__ => $e->getMessage()]);
        }
    }

    public function getUser()
    {
        if (Auth::check())
        {
            return  Auth::user();
        }
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return User::select('id','name','email')->get()->toArray();
    }
}

