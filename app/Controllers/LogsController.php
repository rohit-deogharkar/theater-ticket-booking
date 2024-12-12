<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LogsController extends BaseController
{
    public function postlog($data)
    {
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->post('addlogs', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($data)
        ]);

        $result = json_decode($response->getBody());

        session()->set('logid', $result->_id);
    }

    public function postlogout($data)
    {
        $logid = session('logid');
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->put('updatelogs/' . $logid, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($data)
        ]);

        $result = json_decode($response->getBody());

        // return session('logid');
    }

    public function updatelogactions($data)
    {
        $logid = session('logid');
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->put('update-logs-actions/' . $logid, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($data)
        ]);

        $result = json_decode($response->getBody());
    }

    public function viewlogs()
    {
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->get('getalllogs');

        $data = json_decode($response->getBody());

        return view('navbar')
            . view('logs', ['logs' => $data]);
    }

    public function specificlog($id)
    {
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->get('getspecificlog/' . $id);

        $data = json_decode($response->getBody());

        return view('navbar')
            . view('specificlog', ['actions' => $data]);

        // print_r($data);
    }

    public function forcelogout($id){
        $userid = session('data')->_id;

        if($userid == $id){
            session()->remove('data');
        }
        else{
            return;
        }  
    }
}
