<?php namespace App\Http\Controllers;


use App\Users;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Input;
use Response;
use Session;
use yajra\Datatables\Datatables;

class UsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        View::share('projectTitle', 'ClicSpot');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
//        $users = Auth::user()->campaigns()->with('hotspot')->get();
//        return $users;
        if ($request->ajax()) {
            if (Auth::user()->type == 'superadmin') {
                $users = Users::all();
                
            } else {
                $users = Users::all();
                
                //$users = Auth::user()->campaigns()->select(['id', 'name', 'backgroundimage', 'logoimage', 'fontcolor']);
                
            }
            return Datatables::of($users)
//                ->editColumn('backgroundimage', '<img src="uploads/campaign/{{$backgroundimage}}" height="150" width="300" />')
//                ->editColumn('logoimage', '<img src="uploads/campaign/{{$logoimage}}" height="75" width="150" />')
//                ->editColumn('fontcolor', '<span class="btn btn-default"><i class="fa fa-font" style="color: {{$fontcolor}}"></i></span> {{$fontcolor}}')
//                ->addColumn('edit', function ($users) {
//                    return '<a href="' . url("campaign/{$users->id}/edit") . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
//                })
//                ->addColumn('delete', function ($users) {
//                    return '<a class="btn btn-xs btn-danger" id="delete" href="javascript:void(0);" data-token="' . csrf_token() . '" val=' . $users->id . '><i class="glyphicon glyphicon-trash"></i></a>';
//                })
                ->make(true);
        } else {
            $facebookCount =  Users::where('type','1')->where('profileurl', 'like', '%facebook%')->count();
            $googleCount =  Users::where('type','1')->where('profileurl', 'like', '%google%')->count();
            $emailCount =  Users::where('type','2')->count();
            return view('users.index',['facebookCount' => $facebookCount,'googleCount' => $googleCount,'emailCount'=>$emailCount]);
        }
    }

   

}
