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
use Mail;
use Illuminate\Support\Facades\Input;

class CronController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct() {
        
    }

    public function sendmailTestCron() {
        $userId['userId'] = "1";
        $userId['templateName'] = "sdfs";
        Mail::send('email.emailTemplate', $userId, function ($message) {
            $message->to('bindeshpandya@hotmail.com', 'example_name')->subject('Welcome!');
        });
    }

}
