<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\PostRepositoryInterface as Repo;
use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMailNotification;

class MailController extends Controller
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
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $datas = $this->repo->getPostData($data, null,true);

        $mailData = [
            'title' => 'new blog posts',
            'body' => 'This is for testing email using smtp.'
        ];

        Mail::to('your_email@gmail.com')->send(new SendMailNotification($mailData));

        dd("Email is sent successfully.");
    }
}
