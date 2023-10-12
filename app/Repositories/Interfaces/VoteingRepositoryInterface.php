<?php
namespace App\Repositories\Interfaces;

interface VoteingRepositoryInterface{
    public function upvote($request);
    public function downvote($request);
}
