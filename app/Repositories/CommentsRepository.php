<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Comments;
use App\Models\Feedback;
use App\Jobs\SendEmailJob;
use App\Events\FeedbackUpdates;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\CommentsRepositoryInterface;

class CommentsRepository implements CommentsRepositoryInterface
{
    public function create(array $data)
    {
        $data['user_id'] = Auth::user()->id;
        $comment =  Comments::create($data);
        $feedbacks = Feedback::with(['votes.user','comments.user'])->latest()->get();
        $data = ['feedbacks' => $feedbacks , 'message' => 'This comment is added by User Name' .Auth::user()->name.  ''];
        event(new FeedbackUpdates($data));
        $users = User::all();
        dispatch(new SendEmailJob($users));
        return $comment;
    }

}
