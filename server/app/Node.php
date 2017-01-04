<?php

namespace App;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    function online()
    {
        try {
            $client = new Client(['exceptions' => false]);
            $res = $client->request('GET', $this->url.'/ping',
                    ['connect_timeout' => 1,
                    'headers' => ['X-AllCall-Key' => $this->key]
                    ]);
            if ($res->getStatusCode() == 200)
                return true;
        }
        catch (Exception $e) {
            return false;
        }
    }
    
    function status()
    {
        try {
            $client = new Client(['exceptions' => false]);
            $res = $client->request('GET', $this->url.'/status',
                    ['connect_timeout' => 1,
                    'headers' => ['X-AllCall-Key' => $this->key]
                    ]);
            if ($res->getStatusCode() == 200)
                return json_decode($res->getBody())->response;
            if ($res->getStatusCode() == 401)
                return "Invalid Key";
            else
                return false;
        }
        catch (Exception $e) {
            return false;
        }
    }
}
