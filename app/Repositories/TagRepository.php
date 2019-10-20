<?php
namespace App\Repositories;

use App\Models\Tag;

class TagRepository
{
    public function allForUser()//($user)
    {
        return Tag::orderBy('created_at', 'desc')->get();
    }
    public function findId($tagId)
    {
        return Tag::find($tagId);
    }
}
