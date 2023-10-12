<?php

namespace App\Http\Controllers\FeedbackSystem;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\VoteingRepositoryInterface;

class VoteingController extends Controller
{
    use ApiResponser;
    protected $voteingRepository;

    public function __construct(VoteingRepositoryInterface $voteingRepository) {
        $this->voteingRepository = $voteingRepository;
    }
    public function upvote(Request $request){
        $this->voteingRepository->upvote($request);
        return response()->json(['message' => 'Upvoted successfully']);
    }

    public function downVote(Request $request){
        $this->voteingRepository->upvote($request);
        return response()->json(['message' => 'Downvoted successfully']);
    }
}
