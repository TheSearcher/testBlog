<?php

namespace App\Console\Commands;

use App\Mail\SendMailNotification;
use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Mail;

class ScheduleEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Custom schedule run command for  email post notification';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = $this->getUsers();

        $posts = $this->getPostNotfications();

        if (count($users) > 0 &&  count($posts) > 0) {
            foreach ($users as $user) {

                Mail::to($user['email'])->send(new SendMailNotification(['name'=> $user['name'], 'post'=> $posts]));
            }
        }

        $this->bulkPostEmailUpdate();
    }

    /**
     * @return void
     */
    public function bulkPostEmailUpdate()
    {
        Post::where('email_sent', '!=', 1)->update(['email_sent' => 1]);
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return User::select('id','name','email')->get()->toArray();
    }

    /**
     * @return mixed
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
}
