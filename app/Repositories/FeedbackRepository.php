<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Feedback;
use App\Jobs\SendEmailJob;
use App\Events\FeedbackUpdates;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\FeedbackRepositoryInterface;

class FeedbackRepository implements FeedbackRepositoryInterface
{
    public function create(array $data)
    {
        $data['user_id'] = Auth::user()->id;
        $feedbacks = Feedback::with(['votes.user','comments.user'])->latest()->get();
        $datas = ['feedbacks' => $feedbacks , 'message' => 'This Feedback is added by User Name' .Auth::user()->name.  ''];
        event(new FeedbackUpdates($datas));
        $users = User::all();
        dispatch(new SendEmailJob($users));
        $feedback = Feedback::create($data);
        return $feedback;
    }

    public function getAll()
    {
        $feedbacks =  Feedback::query();
        if (isset($_GET['getAll']) && $_GET['getAll'] == '1') {
            $feedbacks = $feedbacks->orderBy('title', 'asc')->get();
            return  $feedbacks;
        }

        if (isset($_GET['limit']) && $_GET['limit'] != '') {
            $limit = $_GET['limit'];
        } else {
            $limit = 10;
        }

        if (isset($_GET['searchParameter']) && $_GET['searchParameter'] != '') {
            $feedbacks = $feedbacks->where('title', "LIKE", "%" . $_GET['searchParameter'] . "%");
        }

        return  $feedbacks->paginate($limit);

    }

    public function destroy($id){
        $feedback = Feedback::find($id);
        return $feedback->delete();
    }
}
