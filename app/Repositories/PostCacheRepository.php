<?php

namespace App\Repositories;;


use Illuminate\Contracts\Database\Eloquent\Builder;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use App\Repositories\PostRepository;


class PostCacheRepository  implements PostRepositoryInterface
{
    private $postRepo;

    public function __construct(PostRepository $postRepo)
    {
        $this->postRepo = $postRepo;
    }

    /**
     * @return Collection
     */
    public function getPostData($request, $user_id, $users)
    {
        $value = Cache::remember(__FUNCTION__.'_', now()->addDays(2), function () use ($request,$user_id,$users)  {

            return   $this->postRepo->getPostData($request,$user_id,$users);
        });

        return $value;
    }

    /**
     * @return Collection
     */
    public function getPost($id)
    {
        $value = Cache::remember(__FUNCTION__.'_', now()->addDays(2), function () use ($id)  {

            return   $this->postRepo->getPost($id);
        });

        return $value;
    }


    public function getCommentsData($request, $user_id, $users)
    {
        $value = Cache::remember(__FUNCTION__.'_', now()->addDays(2), function () use ($request, $user_id, $users)  {

            return   $this->postRepo->getCommentsData($request, $user_id, $users);
        });

        return $value;
    }

    public function stripTag($tag)
    {
        return $this->theoryTestRepo->sanitizeSlug($tag);
    }


}
