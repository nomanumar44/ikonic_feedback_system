<?php

namespace App\Http\Controllers\FeedbackSystem;

use App\Models\Feedback;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Events\FeedbackUpdates;
use App\Events\FeedbackSendEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Http\Resources\FeedbackResource;
use App\Repositories\Interfaces\FeedbackRepositoryInterface;

class FeedbackController extends Controller
{
    use ApiResponser;
    protected $feedbackRepository;

    public function __construct(FeedbackRepositoryInterface $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    public function index()
    {
        $feedbacks = $this->feedbackRepository->getAll();

        return $this->successResponse(FeedbackResource::collection($feedbacks), 'Data Get Successfully!');
    }

    public function store(FeedbackRequest $request)
    {

        $feedback = $this->feedbackRepository->create($request->all());
        return $this->apiSuccessResponse(new FeedbackResource($feedback), 'Data Get Successfully!');
    }

    public function destroy($id)
    {
        $feedback = $this->feedbackRepository->destroy($id);
        return $this->apiSuccessResponse(new FeedbackResource($feedback), 'Feedback Data Delete Successfully!');
    }

}
