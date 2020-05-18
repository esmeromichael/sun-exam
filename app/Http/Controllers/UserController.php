<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Session;
use Auth;
use App;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    //I can use repository pattern.
    
    public function index(Request $request)
	{
		$lists = User::orderBy('name','asc')->paginate(10);

		if($request->ajax())
		{
			return view('/index_ajax', ['lists' => $lists])->render();
		}

		return view('/home', compact('lists'));
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
    	$user = User::find($request->id);

    	if($user) {
    		User::where('id',$request->id)->delete();

    		return response()->json(array('success' => true, 'message'=> 'Successfully deleted.'));
    	} else {
    		return response()->json(array('success' => true, 'message'=> 'Nothing to delete.'));
    	}
    }


    public function lockedAccount(Request $request)
    {
        $user    = User::where('email', $request->email)->first();
        if($user) {
            $user->locked = 'Yes';
            $user->save();

            return response()->json(array('success' => true, 'message'=> 'Youre reached 3 attempts. Account is locked'));
        } else {
            return response()->json(array('success' => true, 'message'=> 'Nothing to lock.'));
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

    public function login(Request $request)
    {
    	$email = $request->email;
    	$password = $request->password;

    	$auth    = User::where('email', $email)->where('locked','No')->first();
        $not_password = 0;

    	if($auth){
    		if (Hash::check($password, $auth->password)){
                $not_password = 0;
                $auth->updated_at = date('Y-m-d H:i:s');
                $auth->status = 'LoginIn';
                $auth->save();

                Auth::loginUsingId($auth->id);
    			Session::put('username', $auth->name);
    			Session::save();

    			return response()->json(array('success' => true, 'message'=> 'Successfully login.', 'not_password' => $not_password));
    		} else {
                $not_password += 1;
    			return response()->json(array('success' => false, 'message'=> 'Undefined password.', 'not_password' => $not_password));
    		}
    	} else {
            $not_password = 0;
    		return response()->json(array('success' => false, 'message'=> 'Username is undefined.', 'not_password' => $not_password));
    	}

    }

    public function logout()
    {
        $user = User::where('id', auth()->user()->id)->first();

        $user->status = "NotLogin";
        $user->save();

        Auth::logout();
        return redirect('/');
    }


    public function upload(Request $request){
        $environment     =  App::environment();
        $destinationPath = public_path().'/img';
        $imagePath       = url('/') . '/img/';

        $this->validate($request, [
            'file' => 'mimes:jpeg,jpg,bmp,png', //only allow this type extension file.
        ]);

        $file     = $request->file('uploadImage');
        $filename = Carbon::now()->timestamp . '-' . str_replace(' ', '-', $file->getClientOriginalName());

        try {
          $file->move($destinationPath, $filename);
          User::where('id', $request->id)->update(['image' => $filename]);
        }
        catch (\Exception $e) {
            return response()->json(array('success' => false, 'message'=> $e->getMessage()));
        }
        return response()->json(array('success' => true, 'message'=> 'Image updated.', 'image_url' => $imagePath . $filename));
    }
}
