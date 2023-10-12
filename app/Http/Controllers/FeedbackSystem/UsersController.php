<?php

namespace App\Http\Controllers\FeedbackSystem;
use App\Models\User;
use App\Models\Vote;
use App\Models\Comments;
use App\Models\Feedback;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Events\FeedbackSendEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\UsersResource;
use App\Repositories\Interfaces\UserRepositoryInterface;


class UsersController extends Controller
{
    use ApiResponser;
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }
    public function show($id){
        $user = $this->userRepository->find($id);
        return $this->apiSuccessResponse(new UsersResource($user), 'Data Get Successfully!');
    }

    public function uploadImage(Request $request)
    {
        $url = $this->userRepository->userAvater($request);
        return response()->json(['image_url' => $url]);
    }

    public function update(Request $request,$id)
    {
        $data = $request->all();
        $user = $this->userRepository->update($data,$id);
        return $this->successResponse($user, 'User Update Successfully!');
    }

    public function getProduct(){
        $product = $this->userRepository->getProduct();
        return response()->json($product);
    }

    public function getAllData(){
        $feedbacks = Feedback::count();
        $comments = Comments::count();
        $votes = Vote::count();
        $users = User::count();
        return response()->json(['feedbacks'=>$feedbacks,'comments',$comments,'votes' => $votes,'users' => $users],200);
    }
}
