<?php

namespace App\Http\Controllers;

use App\Alert;
use Illuminate\Http\Request;
use Validator;

class AlertController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $alerts = Alert::all();
        return view('alerts.index', compact('alerts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('alerts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'          => 'required',
            'shortname'     => 'required',
            'loop_delay'    => 'required|int',
            'description'   => 'required',
            
        );
        $validator = Validator::make($request->all(), $rules);

        // return errors if needed
        if ($validator->fails()) {
            return redirect('alerts/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $alert = new Alert;
            $alert->name        = $request->input('name');
            $alert->shortname   = $request->input('shortname');
            $alert->loop_delay  = $request->input('loop_delay');
            $alert->description = $request->input('description');
            $alert->save();

            // redirect
            $request->session()->flash('message', 'Successfully created alert!');
            return redirect('alerts');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
     public function show(Alert $alert)
    {
        return view('alerts.show', compact('alert'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Alert $alert)
    {
        return view('alerts.edit', compact('alert'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, Alert $alert)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'          => 'required',
            'shortname'     => 'required',
            'loop_delay'    => 'required|int',
            'description'   => 'required',
            
        );
        $validator = Validator::make($request->all(), $rules);

        // return errors if needed
        if ($validator->fails()) {
            return redirect('alerts/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $alert->name        = $request->input('name');
            $alert->shortname   = $request->input('shortname');
            $alert->loop_delay  = $request->input('loop_delay');
            $alert->description = $request->input('description');
            $alert->save();

            // redirect
            $request->session()->flash('message', 'Successfully updated alert!');
            return redirect('alerts');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, Alert $alert)
    {
        $alert->delete();

        $request->session()->flash('message', 'Successfully deleted alert!');
        return redirect('alerts');
    } 
}
