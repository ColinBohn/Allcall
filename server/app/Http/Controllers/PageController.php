<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Node;
use App\Alert;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function logs()
    {
        $logs = Log::orderBy('created_at', 'desc')->get();;
        return view('logs', compact('logs'));
    }

    public function broadcast()
    {
        $alerts = Alert::all();
        $nodes = Node::all();
        return view('broadcast', compact('nodes', 'alerts'));
    }
}
