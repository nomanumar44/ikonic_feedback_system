<?php
namespace App\Repositories\Interfaces;

interface UserRepositoryInterface{
    public function find($id);
    public function userAvater($request);
    public function getProduct();
    public function update($request,$id);
}
