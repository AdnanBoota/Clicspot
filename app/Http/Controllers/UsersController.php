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
//        $categories = Category::select(DB::raw('categories.*, count(*) as `aggregate`'))
//        ->join('pictures', 'categories.id', '=', 'pictures.category_id')
//        ->groupBy('category_id')
//        ->orderBy('aggregate', 'desc')
//        ->paginate(10);
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
                ->addColumn('favoredconnection', function ($users) {
                    return $users->type;
                })
                ->addColumn('visitor', function ($users) {
                    return $users->name;
                })
                ->addColumn('amountofvisit', function ($users) {
                    return rand(0, 99);
                })
                ->addColumn('lastvisit', function ($users) {
                    return "Nov 2";
                })
                ->addColumn('campaign', function ($users) {
                    return "Campaign Here";
                })
                ->addColumn('review', function ($users) {
                    return "Review Here";
                })
                ->make(true);
        } else {
            $facebookCount =  Users::where('type','1')->where('profileurl', 'like', '%facebook%')->count();
            $googleCount =  Users::where('type','1')->where('profileurl', 'like', '%google%')->count();
            $emailCount =  Users::where('type','2')->count();
            $emailList = Auth::user()->emailList()->select('listname','id')->get();
            return view('users.index',['facebookCount' => $facebookCount,'googleCount' => $googleCount,'emailCount'=>$emailCount,'emailList'=>$emailList]);
        }
    }

   

}
