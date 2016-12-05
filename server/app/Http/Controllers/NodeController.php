<?php

namespace App\Http\Controllers;

use App\Node;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class NodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function test(Node $node)
    {
        $client = new Client();
        $res = $client->request('GET', 'http://'.$node->hostname.'/start/test');
        return redirect('/broadcast');
    }
    
    public function stop(Node $node)
    {
        $client = new Client();
        $res = $client->request('GET', 'http://'.$node->hostname.'/stop');
        return redirect('/broadcast');
    }
}
