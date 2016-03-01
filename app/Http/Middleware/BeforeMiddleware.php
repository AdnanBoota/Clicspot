<?php namespace App\Http\Middleware;

use Closure;
use App;
use Session;

class BeforeMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
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

}
