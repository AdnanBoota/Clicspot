<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Item;
use DB;
use Excel;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\EmailList;
use Auth;
use Illuminate\Support\Facades\View;
use Response;
use Session;
use yajra\Datatables\Datatables;
use App\Campaign;
use App\Hotspot;
use App\User;
use App\Users;
use App\StarsRating;
use App\Http\Controllers\UsersController;


class ListImporter extends Controller
{
	public function importExport()
	{
		$adminObj = Auth::user();
		if(!$adminObj) {
			header("location: /");
			die;
		}

		$routers = Auth::user()->hotspots()->select('ssid','nasidentifier')->lists('ssid', 'nasidentifier');

		if(!$routers || empty($routers)) {
            header("location: /");
            die;
        }

		$languages = array( //added by me@diegopucci.com @pucci_diego
			'en' => '<div class="flag-icon flag-icon-gb" title="Anglais" id="gb"><span style="padding-left: 30px">Anglais</span></div>',
			'fr' => '<div class="flag-icon flag-icon-fr" title="Français" id="fr"><span style="padding-left: 30px">Français</span>',
			'es' => '<div class="flag-icon flag-icon-es" title="Espagnol" id="es"><span style="padding-left: 30px">Espagnol</span>',
			'de' => '<div class="flag-icon flag-icon-de" title="Allemagne" id="de"><span style="padding-left: 30px">Allemagne</span>',
			'nl' => '<div class="flag-icon flag-icon-nl" title="Hollandais" id="nl"><span style="padding-left: 30px">Hollandais</span>',
			'it' => '<div class="flag-icon flag-icon-it" title="Italien" id="it"><span style="padding-left: 30px">Italien</span>',
			'pt' => '<div class="flag-icon flag-icon-pt" title="Portugais" id="pt"><span style="padding-left: 30px">Portugais</span>'
		);

		return View::make('listImporter', compact('routers','languages'));
	}

	public function importExcel()
	{
		$inputs = Input::all();
		$adminid = Auth::user()->id;

		if(Input::hasFile('import_file') && isset($inputs["language"]) && isset($inputs["router"])){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {})->get()->toArray();

			$router = $inputs["router"];
			$lang = $inputs["language"];

			//$ssid = Auth::user()->hotspots()->where('nasidentifier', '=', $router)->lists('ssid');

			$insert = [];

			switch($inputs["importType"]){
				case "clicspot":
					if(!empty($data) && count($data) > 0 &&
						isset($data[0]["firstname"]) &&
						isset($data[0]["lastname"]) &&
						isset($data[0]["email"])
					){
						foreach ($data as $key => $value) {
							if($value["email"] != "") {
								//$random = mt_rand(1000,10000);
								$username = strtoupper("imported-".$value["email"]."-".$router);

								$insert[] = [
									'username' => $username,
									'firstname' => $value["firstname"] != "" ? strtoupper($value["firstname"]) : "",
									'lastname' => $value["lastname"] != "" ? strtoupper($value["lastname"]) : "",
									'email' => $value["email"],
									'language' => isset($value["language"]) && !empty($value["language"]) ? $value["language"] : $lang,
									'gender' => isset($value["gender"]) && !empty($value["gender"]) ? $value["gender"] : null,
									'birthday' => isset($value["birthday"]) && !empty($value["birthday"]) ? $value["birthday"] : null,
									'type' => 3, //fav. connection for clicspot
									'subscribe' => 1,
									'adminid' => $adminid
								];
							}
						}
					}

					break;

				case "zenchef":
					if(!empty($data) && count($data) > 0){
						foreach ($data as $user) {
						$thisUser = explode(";", $user["prenomnomemailtelephonepaysstatut_destinataireinscrit"]);

							if($thisUser[2] != "") {
								//$random = mt_rand(1000,10000);
								$username = strtoupper("imported-".$thisUser[2]."-".$router);
								$insert[] = [
									'username' => $username,
									'firstname' => $thisUser[1] != "" ? strtoupper($thisUser[1]) : "",
									'lastname' => $thisUser[0] != "" ? strtoupper($thisUser[0]) : "",
									'email' => $thisUser[2],
									'language' => $lang,
									'type' => 4, //fav. connection for zenchef,
									'subscribe' => 1,
									'adminid' => $adminid
								];
							}

						}
					}
					break;
			}

			if(!empty($insert)){
				$inserted = 0;
				foreach($insert as $user){
					//checks if the user already exists
					$userExists = DB::table('radacct')->where([
						'username' => $user["username"],
						'calledstationid' => $router
					])->get();

					if(!$userExists){
						//adds the user to the users table
						DB::table('users')->insert($user);
						//adds the user to the raddact table
						DB::table('radacct')->insert([
							'username' => $user["username"],
							'acctuniqueid'=> $user["username"],
							'calledstationid' => $router,
							'acctstarttime' => date("Y-m-d H:i:s")
						]);
						//sets up the rating for the newly inserted user
						\App\StarsRating::insert(['email_id' => $user["email"], 'admin_id' => $adminid, 'points' => 5, 'stars' => \App\StarsRating::returnStarsByPoints(5)]);

						$inserted++;
					}
				}
				echo($inserted);
				die;
			}

		}
		return false;
	}
}
