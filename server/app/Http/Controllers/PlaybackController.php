<?php

namespace App\Http\Controllers;

use App\Node;
use App\Alert;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PlaybackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function start(Request $request, Alert $alert)
    {
        $checked = $request->input('nodes');
        if (!$checked) {
            return redirect('/broadcast');
        }
        $nodes = Node::find($checked);
        foreach ($nodes as $node) {
            $client = new Client();  
            $res = $client->request('GET', 
                    $node->url
                    .'/start/'.$alert->shortname
                    .'/'.$alert->loop_delay,
                    ['connect_timeout' => 3,
                    'headers' => ['X-AllCall-Key' => $node->key]
                    ]);
        }
        return redirect('/broadcast');
    }
    
    public function stop(Request $request)
    {
        $checked = $request->input('nodes');
        if (!$checked) {
            return redirect('/broadcast');
        }
        $nodes = Node::find($checked);
        foreach ($nodes as $node) {
            $client = new Client();
            $res = $client->request('GET',
                    $node->url.'/stop',
                    ['connect_timeout' => 3,
                    'headers' => ['X-AllCall-Key' => $node->key]
                    ]);
        }
        return redirect('/broadcast');
    }
}
