<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Request;
use App\User;
use yajra\Datatables\Datatables;


class VendorController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Home Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders your application's "dashboard" for users that
      | are authenticated. Of course, you are free to change or remove the
      | controller as you wish. It is just here to get your app started!
      |
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        View::share('projectTitle', 'Clic Spot');
    }

    /**
     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function index() {
        if (Request::ajax()) {
            return Datatables::of(User::all()->where('type','vendor'))
            ->addColumn('edit', function ($vendor) {
                return '<a href="' . url("subscribers/{$vendor->id}/edit") . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            })
            ->addColumn('delete', function ($vendor) {
                return '<a id="delete" href="javascript:void(0);" data-token="' . csrf_token() . '" val=' . $vendor->id . ' class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->addColumn('action', function ($vendor) {
                if ($vendor->isactivated == 1) {
                    return '<a id="action" href="javascript:void(0);" data-token="' . csrf_token() . '" val=' . $vendor->id . ' class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove-sign"></i></a>';
                } else {
                    return '<a id="action" href="javascript:void(0);" data-token="' . csrf_token() . '" val=' . $vendor->id . ' class="btn btn-xs btn-success"><i class="glyphicon glyphicon-ok-sign"></i></a>';
                }
            })
            ->editColumn('isactivated', function ($vendor) {
                return ($vendor->isactivated == 1) ? '<span class="label l label-success"><i class="glyphicon glyphicon-ok-sign"></span>' : '<span class="label label-danger"><i class="glyphicon glyphicon-remove-sign"></i></span>';
            })
            ->make(true);
        } else {
            return view('vendor.vendorList');
        }
    }
    
    public function getAction($id)
    {
        $user = User::findOrFail($id);
        if ($user->isactivated) {
            $user->isactivated = 0;
        } else {
            $user->isactivated = 1;
        }
        $user->save();
        return "true";
    }

}
