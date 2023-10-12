<?php
namespace App\Repositories\Interfaces;

interface FeedbackRepositoryInterface
{
    public function create(array $data);
    public function getAll();
    public function destroy($id);
}
