<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{

	public function index(Request $request)
	{
		$lists = Article::orderBy('title','asc')->paginate(10);

		if($request->ajax())
		{
			return view('/index_ajax', ['lists' => $lists])->render();
		}

		return view('/welcome', compact('lists'));
	}

    public function create(Request $request)
    {
    	if($request->data_action == "add"){

    		$create = new Article;
	    	$this->RequestToSave($create,$request);
	    	$create->save();

	    	if($create){
	    		return response()->json(array('success' => true, 'message'=> 'Successfully saved.'));
	    	} else {
	    		return response()->json(array('success' => false, 'message'=> 'Nothing to save.'));
	    	}
    	} else {

    		$id = $request->article_id;

    		$update = Article::find($id);
    		$this->RequestToSave($update,$request);
    		$update->save();

    		if($update){
	    		return response()->json(array('success' => true, 'message'=> 'Successfully updated.'));
	    	} else {
	    		return response()->json(array('success' => false, 'message'=> 'Nothing to update.'));
	    	}
    	}
    	
    }

    public function RequestToSave($create,$request)
    {
    	$create->title   = $request->article_title;
	    $create->content = $request->article_content;
    }

    public function destroy(Request $request)
    {
    	$article = Article::find($request->id);

    	if($article) {
    		Article::where('id',$request->id)->delete();

    		return response()->json(array('success' => true, 'message'=> 'Successfully deleted.'));
    	} else {
    		return response()->json(array('success' => true, 'message'=> 'Nothing to delete.'));
    	}
    }
}
