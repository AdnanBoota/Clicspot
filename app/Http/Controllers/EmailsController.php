<?php namespace App\Http\Controllers;


use App\Campaign;
use App\Hotspot;
use App\HotspotAttributes;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Input;
use Response;
use Session;
use yajra\Datatables\Datatables;
use Mail;

class EmailsController extends Controller
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

    public function getEmail(){
       return View::make('email.email');
    }
    
    public function postEmail(Request $request){
        
        $msgBody =  $request->msgBody;
        $subject =  $request->subject;
//        dd($request);
        $sendToUser = array(array('email'=>'pritesh@logisticinfotech.com','firstName'=>'pritesh'),array('email'=>'nans.noel@gmail.com','firstName'=>'Nans'));
        Mail::send('emails.emailTemplate', array('msgBody' => $msgBody), function ($message) use ($sendToUser, $subject) {
            foreach ($sendToUser as $singleUser){
               $message->to($singleUser['email'], $singleUser['firstName']);
            }
               $message->from('info@clicspot.com', 'Clicspot');
               $message->subject($subject);
        });
        
       $successMsg = "Email send successfully";
       Session::flash('flash_message_success', $successMsg);
       return redirect('emails');
    }
}
