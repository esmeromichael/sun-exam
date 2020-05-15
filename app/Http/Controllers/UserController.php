<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
	{
		$lists = User::orderBy('name','asc')->paginate(10);

		if($request->ajax())
		{
			return view('/index_ajax', ['lists' => $lists])->render();
		}

		return view('/welcome', compact('lists'));
	}

    public function create(Request $request)
    {
    	if($request->data_action == "add"){

    		$create = new User;
	    	$this->RequestToSave($create,$request);
	    	$create->save();

	    	if($create){
	    		return response()->json(array('success' => true, 'message'=> 'Successfully saved.'));
	    	} else {
	    		return response()->json(array('success' => false, 'message'=> 'Nothing to save.'));
	    	}
    	} else {

    		$id = $request->article_id;

    		$update = User::find($id);
    		$this->RequestToSave($update,$request);
    		if($request->password){
    			$update->password = bcrypt($request->password);
    		}
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
    	$create->name  = $request->name;
	    $create->email = $request->email;
	    $create->password = bcrypt($request->password);
    }

    public function destroy(Request $request)
    {
    	$article = User::find($request->id);

    	if($article) {
    		User::where('id',$request->id)->delete();

    		return response()->json(array('success' => true, 'message'=> 'Successfully deleted.'));
    	} else {
    		return response()->json(array('success' => true, 'message'=> 'Nothing to delete.'));
    	}
    }

    public function validateEmail(Request $request)
    {
    	$email = $request->email;
    	$user = 0;

    	$profile = User::where('email',$email)->first();

    	if($profile){
    		$user++;
    	}

    	return response()->json(array('success' => true, 'result'=> $user));
    }

    public function login()
    {
    	
    }
}
