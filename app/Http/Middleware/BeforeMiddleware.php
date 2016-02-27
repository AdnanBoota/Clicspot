<?php namespace App\Http\Middleware;

use Closure;
use App;
use Session;
class BeforeMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
//        echo Session::get('locale'); 
         //App::setLocale(Session::get('locale'));
          //$browser_lang = substr(Request::server('HTTP_ACCEPT_LANGUAGE'), 0, 2);
        $langArr=array("en","fr");
        $languages = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
        //Session::flush();
     
//        if(in_array($languages[0], $langArr))
//              App::setLocale($languages[0]);
        
        if(Session::has('locale')){
           App::setLocale(Session::get('locale')); 
        }
        else
        {
            if(in_array($languages[0], $langArr))
              App::setLocale($languages[0]);
        }
        
        
        
//        print_r($languages);
         //exit;
		return $next($request);
	}

}
