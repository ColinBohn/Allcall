<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Node;
use App\Alert;

class PageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nodes = Node::all();
        return view('home', compact('nodes'));
    }

    public function broadcast()
    {
        $alerts = Alert::all();
        $nodes = Node::all();
        return view('broadcast', compact('nodes', 'alerts'));
    }

}
