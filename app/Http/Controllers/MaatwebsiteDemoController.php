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
use App\Http\Controllers\UsersController;


class MaatwebsiteDemoController extends Controller
{
	public function importExport()
	{
		return view('importExport');
	}
	public function downloadExcel($type)
	{
		$data = Item::get()->toArray();
		return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
			$excel->sheet('mySheet', function($sheet) use ($data)
	        {
				$sheet->fromArray($data);
	        });
		})->download($type);
	}
	public function importExcel()
	{
		if(Input::hasFile('import_file')){
			$path = Input::file('import_file')->getRealPath();
			$data = Excel::load($path, function($reader) {
			})->get();
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $value) {
					$insert[] = [
					'username' => $value->username,
					'type' => $value->type,
					'name' => $value->name,
					'firstname' => $value->firstname,
					'lastname' => $value->lastname,
					'email' => $value->email,
					'language' => $value->language];
				}
				if(!empty($insert)){
					DB::table('users')->insert($insert);
					dd('Insert Record successfully.');
				}
			}
		}
		return back();
	}
}
