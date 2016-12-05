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
            $res = $client->request('GET', 'http://'.$this->hostname.'/ping');
            if ($res->getStatusCode() == 200)
                return true;
        }
        catch (Exception $e) {
            return false;
        }
    }
}
