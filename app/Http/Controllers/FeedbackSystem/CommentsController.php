<?php

namespace App\Http\Controllers\FeedbackSystem;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Repositories\Interfaces\CommentsRepositoryInterface;

class CommentsController extends Controller
{
    use ApiResponser;
    protected $commentsRepository;

    public function __construct(CommentsRepositoryInterface $commentsRepository)
    {
        $this->commentsRepository = $commentsRepository;
    }
    public function store(Request $request){
        $data = $this->commentsRepository->create($request->all());
        return $this->apiSuccessResponse(new CommentResource($data), 'Data Get Successfully!');
    }
}
