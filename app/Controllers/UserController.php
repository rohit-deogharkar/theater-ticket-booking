<?php

namespace App\Controllers;

class UserController extends BaseController
{
    public function __construct(){
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

            print_r($result);
        }
    }

    public function getloginform()
    {
        return view('login');
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

            if($result->message == 'success'){
                session()->set('data',$result->data);
                return redirect()->to('/');
            }
            else{
                return redirect()->back()->withInput()->with('invalidloginmessage', 'Invalid credentials');
            }
            
        }
    }
}


?>