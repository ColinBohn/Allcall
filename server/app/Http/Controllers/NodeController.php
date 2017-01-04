<?php

namespace App\Http\Controllers;

use App\Node;
use Illuminate\Http\Request;
use Validator;
use Input;
use Redirect;

class NodeController extends Controller
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
        $nodes = Node::all();
        return view('nodes.index', compact('nodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('nodes.create');
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
            'name'  => 'required',
            'url'   => 'required | url',
            'key'   => 'required | alpha_num'
        );
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('nodes/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $node = new Node;
            $node->name = $request->input('name');
            $node->url  = $request->input('url');
            $node->key  = $request->input('key');
            $node->save();

            // redirect
            $request->session()->flash('message', 'Successfully created node!');
            return redirect('nodes');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
     public function show(Node $node)
    {
        return view('nodes.show', compact('node'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Node $node)
    {
        return view('nodes.edit', compact('node'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, Node $node)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'name'  => 'required',
            'url'   => 'required | url',
            'key'   => 'required | alpha_num'
        );
        $validator = Validator::make($request->all(), $rules);

        // process the login
        if ($validator->fails()) {
            return redirect('/nodes/'.$node->id.'/edit')
                ->withErrors($validator)
                ->withInput();
        } else {
            // store
            $node->name = $request->input('name');
            $node->url  = $request->input('url');
            $node->key  = $request->input('key');
            $node->save();

            // redirect
            $request->session()->flash('message', 'Successfully updated node!');
            return redirect('nodes');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, Node $node)
    {
        $node->delete();

        $request->session()->flash('message', 'Successfully deleted node!');
        return redirect('nodes');
    }    
    
    public function online(Node $node)
    {
        return json_encode($node->online());
    }
    
    public function status(Node $node)
    {
        return json_encode($node->status());
    }
}