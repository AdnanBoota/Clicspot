<?php namespace App\Http\Controllers;

use App\Subscribers;
use Datatables;
use Illuminate\Support\Facades\View;

class SubscriberController extends Controller
{


    /**
     * Instantiate a new SubscriberController instance.
     */
    public function __construct()
    {
        View::share('projectTitle', 'Nifty Targets');
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('subscribers.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('subscribers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $request = \Request::all();
        if (isset($request['isactive']) && $request['isactive'] == "1") {
            $request['isactive'] = 1;
        } else {
            $request['isactive'] = 0;
        }
        Subscribers::create($request);
        \Session::flash('flash_message_success', 'Subscriber created successfully');
        return redirect('/subscribers');
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
        $subscriber = Subscribers::findOrFail($id);
        return view('subscribers.edit', compact('subscriber'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $request = \Request::all();
        if (isset($request['isactive']) && $request['isactive'] == "1") {
            $request['isactive'] = 1;
        } else {
            $request['isactive'] = 0;
        }
        $subscriber = Subscribers::findOrFail($id);
        $subscriber->update($request);
        \Session::flash('flash_message_success', 'Subscriber updated successfully');
        return redirect('/subscribers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        Subscribers::destroy($id);
        return "true";
    }

    public function getDataTable()
    {
        return Datatables::of(Subscribers::all())
            ->addColumn('edit', function ($subscriber) {
                return '<a href="' . url("subscribers/{$subscriber->id}/edit") . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a>';
            })
            ->addColumn('delete', function ($subscriber) {
                return '<a id="delete" href="#" data-token="' . csrf_token() . '" val=' . $subscriber->id . ' class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></a>';
            })
            ->addColumn('action', function ($subscriber) {
                if ($subscriber->isactive) {
                    return '<a id="action" href="#" data-token="' . csrf_token() . '" val=' . $subscriber->id . ' class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove-sign"></i></a>';
                } else {
                    return '<a id="action" href="#" data-token="' . csrf_token() . '" val=' . $subscriber->id . ' class="btn btn-xs btn-success"><i class="glyphicon glyphicon-ok-sign"></i></a>';
                }
            })
            ->editColumn('isactive', function ($subscriber) {
                return ($subscriber->isactive == 1) ? '<span class="label l label-success"><i class="glyphicon glyphicon-ok-sign"></span>' : '<span class="label label-danger"><i class="glyphicon glyphicon-remove-sign"></i></span>';
            })
            ->make(true);
    }

    public function postAction($id)
    {
        $subscriber = Subscribers::findOrFail($id);
        if ($subscriber->isactive) {
            $subscriber->isactive = 0;
        } else {
            $subscriber->isactive = 1;
        }
        $subscriber->save();
        return "true";
    }

}
