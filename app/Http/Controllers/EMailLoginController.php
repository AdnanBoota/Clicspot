<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Users;
use Illuminate\Http\Request;
use App;
class EMailLoginController extends Controller
{
    public function login(Request $request)
    {
        $data = array(
            'username' => \Session::get('mac'),
            'type' => 2,
            //'name' => $request->input('fname')." ".$request->input('lname'),
            'firstname'=>ucfirst($request->input('fname')),
            'lastname'=>ucfirst($request->input('lname')),
            'email' => $request->input('email'),
            'gender' => null,
            'profileurl' => null,
            'language'=>App::getLocale()
			
            
        );
        $users = Users::where('username', $data['username'])->first();
        if($users){
            if($users['type']==2){
                 $users->update($data);
            }
        }else{
            Users::create($data);
        }
        return redirect(action('HotspotLoginController@login') . "?username=" . $data['username']);
    }
}
