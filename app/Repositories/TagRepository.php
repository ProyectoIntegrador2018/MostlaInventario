<?php
namespace App\Repositories;

use App\Models\Tag;

class TagRepository
{
    public function all()
    {
        return Tag::all();
    }
    public function findId($tagId)
    {
        return Tag::find($tagId);
    }
}
