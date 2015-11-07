<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\EmailList;
use Auth;
use Illuminate\Support\Facades\View;
use Input;
use Response;
use Session;
use yajra\Datatables\Datatables;
use App\Campaign;
use App\Hotspot;
use App\User;
use App\Users;
use App\Http\Controllers\UsersController;

class EmailListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        View::share('projectTitle', 'ClicSpot');
    }

    public function index()
    {
        return redirect('/emailList/create');
    }
    
    
    public function create()
    {
       $routers = Auth::user()->hotspots()->select('nasidentifier')->lists('nasidentifier','nasidentifier'); 
       $profileCount = array('fbCount'=> 0,'gCount'=> 0,'eCount'=>0);
       return view('emailList.create',  compact('routers','profileCount'));
    }
    
    public function store(Request $request)
    {
        $input = Input::all();
        
        
        $this->validate($request,
            [
                'listname' => 'required'
                ]
        );
        if(isset($input['favoredconnection']))
            $input['favoredconnection'] = implode(';', $input['favoredconnection']);
        if(isset($input['visitors']))
            $input['visitors'] = implode(';', $input['visitors']);
        if(isset($input['router']))
            $input['router'] = implode(';', $input['router']);

        $emailList = new EmailList($input);
        Auth::user()->emailList()->save($emailList);

        $successMsg = "New Email List added successfully";
        Session::flash('flash_message_success', $successMsg);
        return redirect('users');
    }
    
    public function edit($id)
    {
       
        $emailList = EmailList::findOrFail($id);
        $emailList->favoredconnection = explode(';', $emailList->favoredconnection);
        $emailList->visitors = ($emailList->visitors) ? explode(';', $emailList->visitors):'';
        $emailList->age = explode(';', $emailList->age);
        $emailList->numberofvisit = explode(';', $emailList->numberofvisit);
        $emailList->router = explode(';', $emailList->router);
        $emailList->datefrom = ($emailList->datefrom != '0000-00-00') ? $emailList->datefrom:'';
        $emailList->dateto = ($emailList->dateto != '0000-00-00') ? $emailList->dateto:'';
        $routers = Auth::user()->hotspots()->select('nasidentifier')->lists('nasidentifier','nasidentifier'); 
        $emailListSelctBox = Auth::user()->emailList()->select('listname','id')->get();
        $profileCount = (new UsersController)->getStatistics($id,'indexCount');
        return view('emailList.edit', compact('emailList','routers','emailListSelctBox','profileCount'));
    }
    
    public function update($id, Request $request)
    {
        $input = Input::all();
        $this->validate($request,
            [
                'listname' => 'required'
            ]
        );
        if (Auth::user()->type == 'superadmin') {
            $emailList = EmailList::findOrFail($id);
        } else {
            $emailList = Auth::user()->emailList()->findOrFail($id);
        }
        
        
        if(isset($input['favoredconnection']))
            $input['favoredconnection'] = implode(';', $input['favoredconnection']);
        if(isset($input['visitors']))
            $input['visitors'] = implode(';', $input['visitors']);
        else
            $input['visitors'] = '';
        if(isset($input['router']))
            $input['router'] = implode(';', $input['router']);

        $emailList->update($input);

        $successMsg = "Email List updated successfully";
        Session::flash('flash_message_success', $successMsg);
        return redirect('users');

        
    }
    
    public function destroy($id)
    {
        $emailList = EmailList::find($id);
        $res = $emailList->delete();
        if ($res) {
            $success = true;
            $msg = "Record Deleted Successfully.";
        } else {
            $success = false;
            $msg = "Something went wrong , Please try again later.";
        }
        return Response::json(array(
            'success' => $success,
            'message' => $msg,
        ));
    }


}
