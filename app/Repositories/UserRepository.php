<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Product;
use App\Models\Feedback;
use Illuminate\Support\Str;
use App\Events\FeedbackUpdates;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository  implements UserRepositoryInterface {
    public function find($id) {
        return User::find($id);
    }

    public function userAvater($request) {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $originalName = $file->getClientOriginalName();
            $fileName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME), '_') . '_' . time() . '.' . $extension;

            $path = $file->move(public_path('uploads'), $fileName);
        }

        $url = 'uploads/' . $fileName;

        return $url;
    }

    public function update($request, $id) {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $request->image;
        $user->password = Hash::make($request->password);
        $user->save();

        return $user;
    }

    public function getProduct(){
        $product = Product::find(1);
        $feedbacks = Feedback::with(['votes.user','comments.user'])->latest()->get();
        $data = ['feedbacks' => $feedbacks , 'message' => ''];
        event(new FeedbackUpdates($data));
        return $product;
    }

}
