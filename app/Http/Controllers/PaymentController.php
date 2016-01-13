<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SubscriptionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use DB;
use Auth;
use Response;
use Carbon;

class PaymentController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        $this->middleware('auth');
        View::share('projectTitle', 'ClicSpot');
    }

    public function index() {
        $adminId = Auth::user()->id;
        $nextBillingDate = "13/01/2017";
        $paymentDetails = SubscriptionHistory::where('adminid', "=", $adminId)->orderBy('id', 'desc')->first();
        if ($paymentDetails) {
            $nextBillingDate = Carbon\Carbon::parse($paymentDetails[0]->nextpaymentdate)->format('d/m/Y');
        }
        return view('payment.index', compact('nextBillingDate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
