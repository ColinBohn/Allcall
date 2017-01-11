<?php

namespace App\Http\Controllers;

use Auth;
use App\Node;
use App\Alert;
use App\Log;
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
        $locations = [];
        foreach ($nodes as $node) {
            $client = new Client();  
            $res = $client->request('GET', 
                    $node->url
                    .'/start/'.$alert->shortname
                    .'/'.$alert->loop_delay,
                    ['connect_timeout' => 3,
                    'headers' => ['X-AllCall-Key' => $node->key]
                    ]);
                    $locations[] = $node->name;
        }
        $log = new Log;
        $log->username = Auth::user()->name;
        $log->locations = implode(", ", $locations);
        $log->action = "START " . $alert->name;
        $log->save();
        return redirect('/broadcast');
    }
    
    public function stop(Request $request)
    {
        $checked = $request->input('nodes');
        if (!$checked) {
            return redirect('/broadcast');
        }
        $nodes = Node::find($checked);
        $locations = [];
        foreach ($nodes as $node) {
            $client = new Client();
            $res = $client->request('GET',
                    $node->url.'/stop',
                    ['connect_timeout' => 3,
                    'headers' => ['X-AllCall-Key' => $node->key]
                    ]);
                    $locations[] = $node->name;
        }
        $log = new Log;
        $log->username = Auth::user()->name;
        $log->locations = implode(", ", $locations);
        $log->action = "STOP";
        $log->save();
        return redirect('/broadcast');
    }
}
