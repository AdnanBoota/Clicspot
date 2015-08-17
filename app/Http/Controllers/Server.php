<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use SSH;
class Server extends Controller {

	public function deploy(){
        SSH::into('production')->run(array(
            'cd /usr/share/nginx/html/clicspot',
            'git pull origin master'
        ));
    }

}
