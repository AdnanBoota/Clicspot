<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Routers;
use App\RouterStatus;
use Carbon\Carbon;
use Request;

class RouterControllerAR71XX extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return "Welcome to API v1";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function config()
    {
        return response()->view('router.ar71xx.config')->header('Content-Type', "text/plain");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($mac)
    {
        $configVersion = Request::get('configversion');
        $router = Routers::where('macaddress', '=', $mac)->first();
        if ($router) {
            $router->update(["configversion" => $configVersion]);
            $router->status()->update(['publicip' => Request::getClientIp(), 'updated_at' => Carbon::now()]);
        } else {
            $router = Routers::create(['macaddress' => $mac, 'model' => 1, 'configversion' => $configVersion]);
            $router->status()->save(new RouterStatus(['publicip' => Request::getClientIp()]));
        }
        return "";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
