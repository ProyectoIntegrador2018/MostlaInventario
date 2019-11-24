<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Repositories\TagRepository;
use Validator;

class TagsController extends Controller
{
    private $tag;
    const RULE_REQ = 'required';
    const STR_CATS = 'tags';

    public function __construct(TagRepository $tag)
    {
        $this->tag = $tag;
    }

    public function index()
    {
        $tags = $this->tag->all();

        return view('profile.tags.index')->with(compact('tags'));
    }

    public function create()
    {
        return view('profile.tags.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules = array(
            'name'             => $this::RULE_REQ
        );

        $messages = array(
            'name.'.$this::RULE_REQ              => 'El nombre es requerido'
        );

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $tagNew = new Tag;
        $tagNew->fillInfo($input);
        
        return redirect($this::STR_CATS);
    }

    public function edit($tagId)
    {
        $tagEdit = $this->tag->findId($tagId);
        
        return view('profile.tags.edit')->with(compact('tagEdit'));
    }

    public function update(Request $request, $tagId)
    {
        $input = $request->all();
        $tagUpdate = $this->tag->findId($tagId);
        
        $rules = array(
            'name'             => $this::RULE_REQ
        );

        $messages = array(
            'name.'.$this::RULE_REQ              => 'El nombre es requerido'
        );

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $tagUpdate->fillInfo($input);
        
        return redirect($this::STR_CATS);
    }

    public function delete($tagId)
    {
        $tagDel = $this->tag->findId($tagId);
        $tagDel->delete();

        return back();
    }

    public function activate($tagId)
    {
        $tagAct = $this->tag->findId($tagId);

        $tagAct->restore();

        return back();
    }
}
