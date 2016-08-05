<?php namespace App\Http\Middleware;

use Closure;
use App;
use Session;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Config;


class BeforeMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */

    protected $except_urls = [
        'api/*'
    ];

    /**	public function handle($request, Closure $next)
    {
        $langArr = array("en", "fr");
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        } else {
            $languages[0] = "en";
        }
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            if (in_array($languages[0], $langArr))
                App::setLocale($languages[0]);
        }
        return $next($request);
    }

	
	    public function handle($request, Closure $next)
    {
        if (Session::has('applocale') AND array_key_exists(Session::get('applocale'), Config::get('languages'))) {
            App::setLocale(Session::get('applocale'));
        }
        else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            App::setLocale(Config::get('app.fallback_locale'));
        }
        return $next($request);
    }
		**/
    public function handle($request, Closure $next)
    {
        if (Session::has('locale')) {
            $locale = Session::get('locale', Config::get('app.locale'));
        } else {
            $locale = substr($request->server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

            if ($locale != 'fr' && $locale != 'en' && $locale != 'es') {
                $locale = 'en';
            }
        }

        App::setLocale($locale);

        return $next($request);
    }

}
