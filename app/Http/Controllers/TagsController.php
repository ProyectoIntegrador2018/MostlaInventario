<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Repositories\TagRepository;

class TagsController extends Controller
{
    private $tag;

    public function __construct(TagRepository $tag)
    {
        $this->tag = $tag;
    }

    public function index()
    {
        $tags = $this->tag->allForUser();

        return view('profile.tags.index')->with(compact('tags'));
    }

    public function create()
    {
        return view('profile.tags.create');
    }
}
