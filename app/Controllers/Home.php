<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function __construct()
    {
        $session = \Config\Services::session();
    }
    public function uploadMovieForm()
    {
        return view('upload_form');
    }

    public function getMovie()
    {
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->get('getMovie');

        $data = json_decode($response->getBody());

        return view('home', ['movies' => $data]);
    }

    public function uploadData()
    {
        $img = $this->request->getFile('imagefile');

        $filepath = $img->store('images', 'newimage.jpg');

        $data = [
            'imagename' => explode("/", $filepath)[1],
            'title' => ucwords(trim($this->request->getPost('movietitle'))),
            'description' => ucfirst(trim($this->request->getPost('description'))),
            'genre' => ucwords(trim($this->request->getPost('moviegenre'))),
            'releasedate' => ucwords(trim($this->request->getPost('releasedate'))),
            'director' => ucwords(trim($this->request->getPost('director'))),
            'language' => ucwords(trim($this->request->getPost('language')))
        ];


        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->post('addmovie', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($data)
        ]);

        $data = json_decode($response->getBody());

        if ($data->result == 'success') {
            return redirect()->to('/')->with('message', 'Movie uploaded successfully');
        } else {
            return redirect()->back()->withinput()->with('message', 'Movie same name already exist');
        }

    }

    public function viewImage($imagename)
    {
        $filepath = WRITEPATH . 'uploads/images/' . $imagename;
        $fileinfo = mime_content_type($filepath);
        header("Content-Type : $fileinfo");
        readfile($filepath);
    }

    public function getMovieDetails($id)
    {
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->get('moviedetail/' . $id);

        $data = json_decode($response->getBody());

        return view('moviedetails', ['movie' => $data]);

    }

    public function updateMovieDetails($id)
    {
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->get('moviedetail/' . $id);

        $data = json_decode($response->getBody());

        return view('update_form', ['movie' => $data]);
    }

    public function postUpdate($id)
    {

        $img = $this->request->getFile('imagefile');

        $filepath = $img->store('images', 'newimage.jpg');

        $data = [
            'imagename' => explode("/", $filepath)[1],
            'title' => ucwords(trim($this->request->getPost('movietitle'))),
            'description' => ucfirst(trim($this->request->getPost('description'))),
            'genre' => ucwords(trim($this->request->getPost('moviegenre'))),
            'releasedate' => ucwords(trim($this->request->getPost('releasedate'))),
            'director' => ucwords(trim($this->request->getPost('director'))),
            'language' => ucwords(trim($this->request->getPost('language')))
        ];


        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->put('updatemovie/' . $id, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($data)
        ]);

        $data = json_decode($response->getBody());

        return redirect()->to('movie-details/' . $id);
    }

    public function deleteMovie($id)
    {
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->delete('deletemovie/' . $id);

        $data = json_decode($response->getBody());
        return redirect()->to('/');
    }

    public function booking($id)
    {
        $emptySeats = [
            'A' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            'B' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            'C' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            'D' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            'F' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
            'G' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
        ];

        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->get('moviedetail/' . $id);

        $data = json_decode($response->getBody());

        $reservedSeats = $data->reservedSeats;

        return view('bookingseats', ['seats' => $emptySeats, 'reservedSeats' => $reservedSeats, 'id' => $id]);
    }

    public function postBooking($id, $seats, $price)
    {
        $selectedseats = explode("_", $seats);

        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        //geting movie data

        $movieresponse = $client->get('moviedetail/' . $id);

        $moviedata = json_decode($movieresponse->getBody());

        $reservedSeats = $moviedata->reservedSeats;

        foreach ($reservedSeats as $reservedSeat) {
            array_push($selectedseats, $reservedSeat);
        }

        //updating seats in moive collection

        $udpateseatresponse = $client->patch('update-reserved-seat/' . $id, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($selectedseats)
        ]);

        $data = json_decode($udpateseatresponse->getBody());

        $userid = session('data')->_id;
        $moviename = $moviedata->title;
        $movieimage = $moviedata->imagename;
        $useremail = session('data')->email;
        $ticketseats = explode("_", $seats);

        $ticketData = [
            'movieimage' => $movieimage,
            'movieId' => $id,
            'userId' => $userid,
            'movieName' => $moviename,
            'email' => $useremail,
            'seats' => $ticketseats,
            'price' => $price
        ];

        $response = $client->post('addticket', [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode($ticketData)
        ]);

        $ticketresponse = json_decode($response->getBody());

        return redirect()->to('ticket/' . $ticketresponse->data->_id);
    }

    public function getTicket($id)
    {
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->get('get-ticket/' . $id);

        $data = json_decode($response->getBody());

        session()->set('ticketStatus', $data->data->status);

        return view('ticket', ['ticket' => $data->data]);

        // print_r(session()->get('data'));
    }

    public function getmytickets($id)
    {
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->get('usertickets/' . $id);

        return view('mytickets');
    }

    public function cancelTicket($id){
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->patch('cancel-ticket/' . $id);

        $data = json_decode($response->getBody());

        return redirect()->to('ticket/'. $id)->with('cancellationSuccess', 'Your Ticket Cancelled Succesfully!');
    }


    public function unauthorized(){
        return view('unauthorized');
    }
}
