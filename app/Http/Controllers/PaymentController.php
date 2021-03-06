<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SubscriptionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\User;
use GoCardless;
use DB;
use Auth;
use Response;
use Carbon;
use Illuminate\Support\Facades\Input;
use Hash;
use Session;

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
        $resourceID = "XXXXXXXXXXXXNIL";
        $paymentDetails = SubscriptionHistory::where('adminid', "=", $adminId)->where("amount", "!=", '3000')->orderBy('id', 'desc')->first();
        $billingDetails = SubscriptionHistory::where('adminid', "=", $adminId)->get();

        if ($paymentDetails) {
            $nextBillingDate = Carbon\Carbon::parse($paymentDetails->nextpaymentdate)->format('d/m/Y');
            $len = strlen($paymentDetails->resourceid);


            $resourceID = substr($paymentDetails->resourceid, 0, 1) . str_repeat('*', $len - 2) . substr($paymentDetails->resourceid, $len - 1, 1);
        }
        return view('payment.index', compact('nextBillingDate', 'resourceID', 'billingDetails'));
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

    public function goCardlessNewRegistration(request $request) {

        $adminId = Auth::user()->id;
        $paymentDetails = User::where('id', "=", $adminId)->get();

        $account_details = array(
            'app_id' => "5SJ55WHN3JFTKBHA4PG682K71EQGRVR1J0Y2SV5FDW7Z929AAR3AFPXM595F74PN",
            'app_secret' => "5PDQFQESW198M4B33FYTF3CAF4K9JS7V2EZ0NYGF2M9ECC00YNYQ0BCAFB7Q9BC3",
            'merchant_id' => "12BP5Z9GEW",
            'access_token' => "SWAY299T209S0FW04DN755GSSXCR5YK586W6YMN9QXYT4H1EH6TBPFB1E0T1B065"
        );
        \GoCardless::set_account_details($account_details);


        $payment_details = array(
            'max_amount' => '3000.00',
            'interval_length' => 12,
            'interval_unit' => 'month',
            'user' => array(
                'first_name' => $paymentDetails[0]->username,
                'last_name' => $paymentDetails[0]->username,
                'email' => $paymentDetails[0]->email,
                'address_line1' => $paymentDetails[0]->address,
                'city' => $paymentDetails[0]->city,
                'postal_code' => $paymentDetails[0]->zip,
            ),
            'redirect_uri' => url('/') . '/payment/goCardlessConfirm'
        );

        $pre_auth_url = \GoCardless::new_pre_authorization_url($payment_details);
        return $pre_auth_url;
    }

    public function goCardlessNewRegistrationConfirm(request $request) {
        $account_details = array(
            'app_id' => "5SJ55WHN3JFTKBHA4PG682K71EQGRVR1J0Y2SV5FDW7Z929AAR3AFPXM595F74PN",
            'app_secret' => "5PDQFQESW198M4B33FYTF3CAF4K9JS7V2EZ0NYGF2M9ECC00YNYQ0BCAFB7Q9BC3",
            'merchant_id' => "12BP5Z9GEW",
            'access_token' => "SWAY299T209S0FW04DN755GSSXCR5YK586W6YMN9QXYT4H1EH6TBPFB1E0T1B065"
        );
        \GoCardless::set_account_details($account_details);
        if (isset($_GET['resource_id']) && isset($_GET['resource_type'])) {
            session([
                'resource_id' => $_GET['resource_id']
            ]);
            $confirm_params = array(
                'resource_id' => $_GET['resource_id'],
                'resource_type' => $_GET['resource_type'],
                'resource_uri' => $_GET['resource_uri'],
                'signature' => $_GET['signature']
            );
            if (isset($_GET['state'])) {
                $confirm_params['state'] = $_GET['state'];
            }
            $confirmed_resource = \GoCardless::confirm_resource($confirm_params);
            $input['adminid'] = Auth::user()->id;
            $input['resourceid'] = $_GET['resource_id'];
            $input['amount'] = "3000";
            $input['description'] = "New Bank Account Added";
            $sub = new SubscriptionHistory($input);
            $updateAdmin = array(
                "resourceid" => $_GET['resource_id']
            );
            $sub->save();
            $adminUp = new User();
            $adminUp->update($updateAdmin);
            $paBill = url("/") . "/payment";
            return redirect($paBill);
        }
    }

    public function editUser($id) {
        $uid=Auth::user()->id; 
        $userDetails = User::find($uid);
        //print_r($userDetails); exit;
        return view('payment.editprofile', compact('userDetails'));
    }

    public function updateUser(Request $request) {
//        $this->validate($request, [
//            'username' => 'required|unique:admin_user',
//            'businessname' => 'required',
//            'email' => 'required|unique:admin_user|email,'. Auth::user()->id,
//            'password' => 'required|confirmed',
//            'password_confirmation' => 'required|same:password',
//            'phone' => 'required',
//            'address' => 'required',
//            'city' => 'required',
//            'zip' => 'required',
//            'country' => 'required',
//            'siren'=>'required',
//            'nvat'=>'required'
//            ]
//        );
        $input = Input::all();
        
        if(isset($input['basic'])){
        //print_r($input); 
            $formField = array(
            'username' => $input['username'],
            'email' => $input['email'],
            'businessname' => $input['businessname'],
            'address' => $input['address'],
            'city' => $input['city'],
            'zip' => $input['zip'],
            'country' => $input['country'],
            'phone' => $input['phone'],
            'siren' => $input['siren'],
            'nvat' => $input['nvat']
        );
        //print_r($formField); exit;
           // echo Auth::user()->id; exit;
            $adminUSer =User::find(Auth::user()->id);
               $adminUSer->username=$input['username'];
               $adminUSer->email=$input['email'];
               $adminUSer->businessname=$input['businessname'];
               $adminUSer->address=$input['address'];
               $adminUSer->city=$input['city'];
               $adminUSer->zip=$input['zip'];
               $adminUSer->country=$input['country'];
               $adminUSer->phone=$input['phone'];
               $adminUSer->siren=$input['siren'];
               $adminUSer->nvat=$input['nvat'];
               $adminUSer->update();
//$adminUSer->update($formField);
            $successMsg = "Profile update successfully";
            Session::flash('flash_message_success', $successMsg);
        }
        if(isset($input['pass'])){
            
            $user=User::where('id','=',Auth::user()->id)->first();
            
            $checkpass=Hash::check($input['oldpassword'], $user->password);
            if($checkpass==1){
            $formField = array(
            'password'=>Hash::make($input['newpassword'])
             );    
            $adminUSer = User::find(Auth::user()->id);
            $adminUSer->update($formField);
            
            $successMsg = "Password update successfully";
            Session::flash('flash_message_success', $successMsg);
            }else{
                $successMsg = "Somthing wrong try again.";
            Session::flash('flash_message_error', $successMsg);
            }
        }
        
        return redirect("/payment");
        
    }

    public function billDetails() {
          $account_details = array(
            'app_id' => "5SJ55WHN3JFTKBHA4PG682K71EQGRVR1J0Y2SV5FDW7Z929AAR3AFPXM595F74PN",
            'app_secret' => "5PDQFQESW198M4B33FYTF3CAF4K9JS7V2EZ0NYGF2M9ECC00YNYQ0BCAFB7Q9BC3",
            'merchant_id' => "12BP5Z9GEW",
            'access_token' => "SWAY299T209S0FW04DN755GSSXCR5YK586W6YMN9QXYT4H1EH6TBPFB1E0T1B065"
        );
        \GoCardless::set_account_details($account_details);
        $bill = \GoCardless_Bill::find('PM0000ZZRACXT0');
        echo '<pre>';
        print_r($bill);
    }

}
