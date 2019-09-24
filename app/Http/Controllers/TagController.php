<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
{
    public function index(){
        $tags=Tag::paginate(env('PAGINATION_COUNT'));
        return view('admin.tags.tags')->with(['tags'=>$tags,'showLinks'=>true]);
    }

    public  function store(Request $request){
$request->validate([
    'tag_name'=>'required'
]);

$tagName=$request->input('tag_name');
$tag=Tag::where('tag','=', $tagName)->get();

if(count($tag)>0){
    session::flash('message','tag ' .$tagName. ' reade exists');
       return redirect()->back();
}
$newTag=new Tag();
$newTag->tag=$tagName;
$newTag->save();
session::flash('message','tag'.$tagName.'has been add');
return redirect()->back();

    }

public  function  search(Request $request){

    $request->validate([
        'tag_search'=>'required'
    ]);
    $searchTerm=$request->input('tag_search');
    $tags=Tag::where(
        'tag','LIKE','%'.$searchTerm.'%'
    )->get();

    if (count($tags)>0){
        return view('admin.tags.tags')->with(
            ['tags'=>$tags,
                'showLinks'=>false,
            ]
        );
    }
    session::flash('message' , 'Unit not found !!');
    return redirect()->back();


}

public  function  delete(Request $request){
$request->validate([
    'tag_id'=>'required'
]);
$tagID=$request->input('tag_id');
$tag=Tag::destroy($tagID);
Session::flash('message','Tag has been deleted');
return redirect()->back();
}


    private function tagNameExists($tagName){
        $tag=Tag::where(
            'tag','=',$tagName
        )->first();

        if (!is_null($tag)){
            session::flash('message','Tag name already exists');
            return false;
        }
            return true;
    }

public  function update(Request $request){
$request->validate(['tag_name'=>'required','tag_id'=>'required']);
$tagName=$request->input('tag_name');
$tagId=$request->input('tag_id');
if (!$this->tagNameExists($tagName)){
    session::flash('message','Tag name already exists');
return redirect()->back();
}
$tag=Tag::find($tagId);
$tag->tag=$tagName;
$tag->save();
session::flash('message','Tag has been add');
    return redirect()->back();

}
}
