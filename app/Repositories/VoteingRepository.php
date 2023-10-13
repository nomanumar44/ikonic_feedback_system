<?php
namespace App\Repositories;

use App\Models\Vote;
use App\Models\Feedback;
use App\Events\FeedbackUpdates;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\VoteingRepositoryInterface;

class VoteingRepository implements VoteingRepositoryInterface
{
    public function upvote($request)
    {
        $user_id = auth()->id();
        $existingVote = Vote::where('user_id', $user_id)
            ->where('feedback_id', $request->feedback_id)->where('vote_type','upvote')
            ->first();

        if ($existingVote) {
            $existingVote->delete();
        } else {
            Vote::create([
                'user_id' => $user_id,
                'feedback_id' => $request->feedback_id,
                'vote_type' => 'upvote',
            ]);
            $feedback = Feedback::find($request->feedback_id);
            $feedback->vote_count++;
            $feedback->save();
            $feedbacks = Feedback::with(['votes.user','comments.user'])->latest()->get();
            $data = ['feedbacks' => $feedbacks , 'message' => 'This Vote is added by User Name' .Auth::user()->name.  ''];
            event(new FeedbackUpdates($data));
            return true;
        }
    }

    public function downvote($request)
    {
        $user_id = auth()->id();

       $existingVote = Vote::where('user_id', $user_id)
            ->where('feedback_id', $request->feedback_id)->where('vote_type','downvote')
            ->first();

        if ($existingVote) {
            $existingVote->delete();
        } else {
            Vote::create([
                'user_id' => $user_id,
                'feedback_id' => $request->feedback_id,
                'vote_type' => 'downvote',
            ]);

            $feedback = Feedback::find($request->feedback_id);
            $feedback->vote_count--;
            $feedback->save();
            $feedbacks = Feedback::with(['votes.user','comments.user'])->latest()->get();
            $data = ['feedbacks' => $feedbacks , 'message' => 'This Vote is added by User Name' .Auth::user()->name.  ''];
            event(new FeedbackUpdates($data));
            return true;
        }

    }

}
