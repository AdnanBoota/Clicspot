<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\Hotspot;
use App\HotspotAttributes;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\User;
use App\SubscriptionHistory;
use App\Transactions;
use GoCardless;
use Input;
use Response;
use Session;
use Mail;
use yajra\Datatables\Datatables;

class HotspotController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
        View::share('projectTitle', 'ClicSpot');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            if (Auth::user()->type == 'superadmin') {
                $hotspot = Hotspot::with(['status'])->select(['id', 'shortname', 'nasidentifier']);
            } else {
                $hotspot = Auth::user()->hotspots()->with(['status'])->select(['id', 'shortname', 'nasidentifier']);
            }
            return Datatables::of($hotspot)
                            ->addColumn('edit', function ($hotspot) {
                                return '<a href="' . url("hotspot/{$hotspot->id}/edit") . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
                            })
                            ->addColumn('delete', function ($hotspot) {
                                return '<a class="btn btn-xs btn-danger" id="delete" href="javascript:void(0);" data-token="' . csrf_token() . '" val=' . $hotspot->id . '><i class="glyphicon glyphicon-trash"></i></a>';
                            })
                            ->addColumn('publicip', function ($hotspot) {
                                return $hotspot->status->publicip;
                            })
                            ->setRowClass(function ($hotspot) {
                                if ((time() - strtotime($hotspot->status->updated_at)) < 180) {
                                    return 'success';
                                } else {
                                    return 'danger';
                                }
                            })
                            ->addColumn('lastcheckin', function ($hotspot) {
                                return $hotspot->status->updated_at->diffForHumans();
                            })
                            ->addColumn('status', function ($hotspot) {
                                if ((time() - strtotime($hotspot->status->updated_at)) < 180) {
                                    return '<i class="fa fa-circle" style="color: green;"></i> Up';
                                } else {
                                    return '<i class="fa fa-circle" style="color: red;"></i> Down';
                                }
                            })
                            ->make(true);
        } else {
            return view('hotspot.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        if (Auth::user()->type == 'superadmin') {
            $campaign = Auth::user()->campaigns()->lists('name', 'id');
        } else {
            $campaign = Auth::user()->campaigns()->lists('name', 'id');
        }
        $hotspotDetails = array();
        $readonly = Session::has('mac') ? "readonly" : "";
        return View::make('hotspot.create', compact('campaign', 'hotspotDetails', 'readonly'));
    }

    public function createClone() {
        //return View::make('hotspot.create');
        return View::make('hotspot.create1');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $input = Input::all();
        $nasRule = 'required|exists:routers,macaddress|unique:nas';

//        if ($id) {
//            $nasRule .= ',nasidentifier,' . $id;
//        }
        $this->validate($request, [
            'shortname' => 'required',
            'nasidentifier' => $nasRule,
            'address' => 'required',
            "redirectUrl" => "required|url"]
        );
        $hotspot = new Hotspot($input);
        Auth::user()->hotspots()->save($hotspot);
        // This function is need to call for charging cutomer on hotspot adding and commented for testing 
    //    $this->userSubscription();     
        Session::remove('mac');
        $hotAttrArr = array(
            new HotspotAttributes(array('attribute' => 'ChilliSpot-Bandwidth-Max-Up', 'type' => 1, 'value' => $request->input('ChilliSpot-Bandwidth-Max-Up'))),
            new HotspotAttributes(array('attribute' => 'ChilliSpot-Bandwidth-Max-Down', 'type' => 1, 'value' => $request->input('ChilliSpot-Bandwidth-Max-Down'))),
            new HotspotAttributes(array('attribute' => 'Session-Timeout', 'type' => 1, 'value' => $request->input('Session-Timeout'))),
            new HotspotAttributes(array('attribute' => 'Idle-Timeout', 'type' => 1, 'value' => $request->input('Idle-Timeout'))),
            new HotspotAttributes(array('attribute' => 'ChilliSpot-Bandwidth-Max-Up', 'type' => 2, 'value' => $request->input('EMail_ChilliSpot-Bandwidth-Max-Up'))),
            new HotspotAttributes(array('attribute' => 'ChilliSpot-Bandwidth-Max-Down', 'type' => 2, 'value' => $request->input('EMail_ChilliSpot-Bandwidth-Max-Down'))),
            new HotspotAttributes(array('attribute' => 'Session-Timeout', 'type' => 2, 'value' => $request->input('EMail_Session-Timeout'))),
            new HotspotAttributes(array('attribute' => 'Idle-Timeout', 'type' => 2, 'value' => $request->input('EMail_Idle-Timeout')))
        );

        $hotspot->hotspotAttributes()->saveMany($hotAttrArr);
        $successMsg = "New Hotspot added successfully";
        Session::flash('flash_message_success', $successMsg);
        return redirect('hotspot');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id) {
        $campaign = Campaign::getDefaultCampaign()->lists('name', 'id');
        if (Auth::user()->type == 'superadmin') {
            $userCampaign = Hotspot::find($id)->user->campaigns()->lists('name', 'id');
        } else {
            $userCampaign = Auth::user()->campaigns()->lists('name', 'id');
        }
        $campaign += $userCampaign;
        $hotspot = Hotspot::findOrFail($id);
        $attributes = $hotspot->hotspotAttributes;
        foreach ($attributes as $key => $value) {
            if ($value['type'] == 1) {
                $hotspot[$value['attribute']] = $value['value'];
            } else {
                $hotspot["EMail_" . $value['attribute']] = $value['value'];
            }
        }
        $readonly = Session::has('mac') ? "readonly" : "";
        return view('hotspot.edit', compact('hotspot', 'campaign', 'readonly'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id, Request $request) {
        $input = Input::all();
        $nasRule = 'required|exists:routers,macaddress|unique:nas,nasidentifier,' . $id;

        $this->validate($request, [
            'shortname' => 'required',
            'nasidentifier' => $nasRule,
            'address' => 'required']
        );
        if (Auth::user()->type == 'superadmin') {
            $hotspot = Hotspot::findOrFail($id);
        } else {
            $hotspot = Auth::user()->hotspots()->findOrFail($id);
        }

        $hotspot->update($input);

        $hotspot->hotspotAttributes()->firstOrCreate(['attribute' => 'ChilliSpot-Bandwidth-Max-Up', 'type' => 1])
                ->update(['value' => $request->input('ChilliSpot-Bandwidth-Max-Up')]);

        $hotspot->hotspotAttributes()->firstOrCreate(['attribute' => 'ChilliSpot-Bandwidth-Max-Down', 'type' => 1])
                ->update(['value' => $request->input('ChilliSpot-Bandwidth-Max-Down')]);

        $hotspot->hotspotAttributes()->firstOrCreate(['attribute' => 'Session-Timeout', 'type' => 1])
                ->update(['value' => $request->input('Session-Timeout')]);

        $hotspot->hotspotAttributes()->firstOrCreate(['attribute' => 'Idle-Timeout', 'type' => 1])
                ->update(['value' => $request->input('Idle-Timeout')]);


        $hotspot->hotspotAttributes()->firstOrCreate(['attribute' => 'ChilliSpot-Bandwidth-Max-Up', 'type' => 2])
                ->update(['value' => $request->input('EMail_ChilliSpot-Bandwidth-Max-Up')]);

        $hotspot->hotspotAttributes()->firstOrCreate(['attribute' => 'ChilliSpot-Bandwidth-Max-Down', 'type' => 2])
                ->update(['value' => $request->input('EMail_ChilliSpot-Bandwidth-Max-Down')]);

        $hotspot->hotspotAttributes()->firstOrCreate(['attribute' => 'Session-Timeout', 'type' => 2])
                ->update(['value' => $request->input('EMail_Session-Timeout')]);

        $hotspot->hotspotAttributes()->firstOrCreate(['attribute' => 'Idle-Timeout', 'type' => 2])
                ->update(['value' => $request->input('EMail_Idle-Timeout')]);

        $successMsg = "Hotspot updated successfully";
        Session::flash('flash_message_success', $successMsg);
        return redirect('hotspot');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id) {
        $hotsopt = Hotspot::find($id);
        $res = $hotsopt->delete();
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

    public function datatable() {
        return "";
    }

    public function userSubscription() {
        $account_details = array(
            'app_id' => "5SJ55WHN3JFTKBHA4PG682K71EQGRVR1J0Y2SV5FDW7Z929AAR3AFPXM595F74PN",
            'app_secret' => "5PDQFQESW198M4B33FYTF3CAF4K9JS7V2EZ0NYGF2M9ECC00YNYQ0BCAFB7Q9BC3",
            'merchant_id' => "12BP5Z9GEW",
            'access_token' => "SWAY299T209S0FW04DN755GSSXCR5YK586W6YMN9QXYT4H1EH6TBPFB1E0T1B065"
        );
        $userId = User::findOrFail(Auth::user()->id);
        if (!empty($userId)) {
            $resourceid = $userId->resourceid;
            \GoCardless::set_account_details($account_details);
            $pre_auth = \GoCardless_PreAuthorization::find($resourceid);
            $bill_details = array(
                'name' => $userId->username,
                'amount' => '200.00',
                'currency' => 'EUR',
                'charge_customer_at' => date('Y-m-d', strtotime('+1 years'))
            );
            $input['resourceid'] = $resourceid;
            $input['amount'] = $bill_details['amount'];
            $input['status'] = 'success';
            $subScriptionHistory['amount'] = $bill_details['amount'];
            $subScriptionHistory['resourceid'] = $resourceid;
            $subScriptionHistory['nextpaymentdate'] = date('Y-m-d', strtotime('+1 years'));
            $subScriptionHistory['description'] = $bill_details['amount'] . " will submitted to your account on " . date('Y-m-d', strtotime('+1 years'));
            try {
                $bill = $pre_auth->create_bill($bill_details);
                $subScriptionHistory['billid'] = $bill->id;
                $input['billid'] = $bill->id;
                $input['paymentstatus'] = "paid";
                $subScriptionHistory['paymentstatus'] = "Success";
            } catch (\GoCardless_ApiException $e) {
                $response = $e->getResponse();
                $message = substr($response['errors']['pre_authorization'][0], 0, 24);
                $input['reason'] = $message;
                $input['status'] = 'fails';
                $input['paymentstatus'] = "fails";
                $subScriptionHistory['paymentstatus'] = "fails";
            }

            $sub = new SubscriptionHistory($subScriptionHistory);
            $result = $sub->save();
            $trans = new Transactions($input);
            $res = $trans->save();
        }
    }

    public function allUserSubscriptionCheck() {

        $account_details = array(
            'app_id' => "5SJ55WHN3JFTKBHA4PG682K71EQGRVR1J0Y2SV5FDW7Z929AAR3AFPXM595F74PN",
            'app_secret' => "5PDQFQESW198M4B33FYTF3CAF4K9JS7V2EZ0NYGF2M9ECC00YNYQ0BCAFB7Q9BC3",
            'merchant_id' => "12BP5Z9GEW",
            'access_token' => "SWAY299T209S0FW04DN755GSSXCR5YK586W6YMN9QXYT4H1EH6TBPFB1E0T1B065"
        );
        $userId = SubscriptionHistory::select('*')
                ->join('admin_user', 'admin_user.id', '=', 'subscription_history.adminid')
                ->where('nextpaymentdate', '=', new \DateTime('today'))
                ->get();

        if (!empty($userId)) {
            foreach ($userId as $key => $value) {


                $resourceid = $value->resourceid;
                \GoCardless::set_account_details($account_details);
                $pre_auth = \GoCardless_PreAuthorization::find($resourceid);
                $bill_details = array(
                    'name' => $value->username,
                    'amount' => '200.00',
                    'currency' => 'EUR',
                    'charge_customer_at' => date('Y-m-d', strtotime('+1 years'))
                );
                $input['resourceid'] = $resourceid;
                $input['amount'] = $bill_details['amount'];
                $input['status'] = 'success';
                $subScriptionHistory['amount'] = $bill_details['amount'];
                $subScriptionHistory['resourceid'] = $resourceid;
                $subScriptionHistory['nextpaymentdate'] = date('Y-m-d', strtotime('+1 years'));
                $subScriptionHistory['description'] = $bill_details['amount'] . " will submitted to your account on " . date('Y-m-d', strtotime('+1 years'));
                try {
                    $bill = $pre_auth->create_bill($bill_details);
                    $subScriptionHistory['billid'] = $bill->id;
                    $input['billid'] = $bill->id;
                    $input['paymentstatus'] = "paid";
                    $subScriptionHistory['paymentstatus'] = "Success";
                } catch (\GoCardless_ApiException $e) {
                    $response = $e->getResponse();
                    $message = substr($response['errors']['pre_authorization'][0], 0, 24);
                    $input['reason'] = $message;
                    $input['status'] = 'fails';
                    $input['paymentstatus'] = "fails";
                    $subScriptionHistory['paymentstatus'] = "fails";
                }

                $sub = new SubscriptionHistory($subScriptionHistory);
                $result = $sub->save();
                $trans = new Transactions($input);
                $res = $trans->save();
            }
        }
    }

    public function sendmailTestCron() {
            $userId['userId'] =Auth::user()->id;
             $userId['templateName'] ="temp";
        Mail::send('email.emailTemplate', $userId, function ($message) {
            $message->to('bindeshpandya@hotmail.com', 'example_name')->subject('Welcome!');
        });
    }

}
