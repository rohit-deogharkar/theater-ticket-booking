<?php

namespace App\Controllers;
use App\Controllers\LogsController;
use CodeIgniter\I18n\Time;
class UserController extends BaseController
{
    // public $logs = new LogsController();
    public function __construct()
    {
        $session = \Config\Services::session();

    }
    public function getregisterform()
    {
        return view('register');

    }

    public function postregisterform()
    {
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (empty($username) || empty($email) || empty($password)) {
            return redirect()->back()->withInput()->with('requiredfieldmessage', 'Please fill in all fields.');
        } else {
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $password
            ];

            $client = service('curlrequest', [
                'baseURI' => 'http://localhost:4000/',
            ]);

            $response = $client->post('adduser', [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($data)
            ]);

            $result = json_decode($response->getBody());

            // print_r($result);
            return redirect()->to('/login');
        }
    }

    public function getloginform()
    {
        if (session()->has('data')) {
            return redirect()->to('/');
        } else {
            return view('login');
        }
    }

    public function postloginform()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        if (empty($email) || empty($password)) {
            return redirect()->back()->withInput()->with('requiredfieldmessage', 'Please fill in all fields.');
        } else {
            $data = [
                'email' => $email,
                'password' => $password
            ];

            $client = service('curlrequest', [
                'baseURI' => 'http://localhost:4000/',
            ]);

            $response = $client->post('checkuser', [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($data)
            ]);

            $result = json_decode($response->getBody());

            if ($result->message == 'success') {
                session()->set('data', $result->data);
                session()->set('role', $result->data->role);
                $myTime = Time::now('Asia/Kolkata', 'en_US');
                $logdata = [
                    'userid' => $result->data->_id,
                    'email' => $result->data->email,
                    'logInTime' => (string) $myTime
                ];
                // print_r((string)$myTime);
                // echo $myTime;
                $logs = new LogsController();
                $logs->postlog($logdata);
                echo session('logid');
                return redirect()->to('/');
            } else {
                return redirect()->back()->withInput()->with('invalidloginmessage', 'Invalid credentials');
            }
        }
    }

    public function logout()
    {
        $myTime = Time::now('Asia/Kolkata', 'en_US');
        $logdata = [
            'logOutTime' => (string)$myTime
        ];
        $logs = new LogsController();
        $logs->postlogout($logdata);

        session()->destroy();
        return redirect()->to('/login');
    }



}   

?>