<?php

namespace App\Repositories\Interfaces;

interface PostRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function getPost($id);


    /**
     * @param $request
     * @param $user_id
     * @param $user
     * @return mixed
     */
    public function getPostData($request, $user_id, $user);

    /**
     * @param $request
     * @param $user_id
     * @param $users
     * @return mixed
     */
    public function getCommentsData($request, $user_id, $users);

    /**
     * @param $data
     * @param $method
     * @param $id
     * @return mixed
     */
    public function updateData($data, $method, $id);

    /**
     * @param $data
     * @param $method
     * @return mixed
     */
    public function saveData($data, $method);

    /**
     * @return mixed
     */
    public function bulkPostEmailUpdate();
}




