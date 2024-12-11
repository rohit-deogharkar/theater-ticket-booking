<?php

namespace App\Controllers;
use Dompdf\Dompdf;

class Home extends BaseController
{
    public function __construct()
    {
        $session = \Config\Services::session();
    }
    public function uploadMovieForm()
    {
        return view('navbar')
            . view('upload_form');
    }

    public function getMovie()
    {
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $maintitle = $this->request->getGet('searchedMovie');
        $title = ucwords(trim($maintitle));

        $movie['title'] = $title;

        if ($title) {
            $response = $client->get('search-movie', [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($movie)
            ]);

            $data = json_decode($response->getBody());

            return view('navbar')
                . view('home', ['movies' => $data, 'tittle' => $maintitle]);
        }

        $response = $client->get('getMovie');

        $data = json_decode($response->getBody());

        return view('navbar')
            . view('home', ['movies' => $data]);

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

        return view('navbar')
            . view('moviedetails', ['movie' => $data]);

    }

    public function updateMovieDetails($id)
    {
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->get('moviedetail/' . $id);

        $data = json_decode($response->getBody());

        return view('navbar')
            . view('update_form', ['movie' => $data]);
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
        if (session()->has('ticketbooked')) {
            session()->remove('ticketbooked');
            return redirect()->to('/');
        } else {
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
    }

    public function postBooking()
    {
        $id = $this->request->getGet('movieId');
        $seats = $this->request->getGet('bookedSeats');
        $price = $this->request->getGet('price');

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
        session()->set('ticketbooked', 'ticketbooked success');
        return redirect()->to('ticket/' . $ticketresponse->data->_id);

    }

    public function getTicket($id)
    {
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->get('get-ticket/' . $id);

        $data = json_decode($response->getBody());

        return view('navbar')
            . view('buttons/downloadticket', ['ticket' => $data->data])
            . view('ticket', ['ticket' => $data->data])
            . view('buttons/cancelticket', ['ticket' => $data->data]);

        // print_r(session()->get('data'));
    }

    public function getmytickets($id)
    {
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->get('usertickets/' . $id);

        $data = json_decode($response->getBody());

        // print_r($data);

        return view('navbar')
            . view('mytickets', ['tickets' => $data->data]);
    }

    public function alltickets()
    {
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->get('alltickets');

        $data = json_decode($response->getBody());

        // print_r($data);

        $quantities['totaltickets'] = 0;
        $quantities['confirmedtickets'] = 0;
        $quantities['cancelledtickets'] = 0;
        $quantities['total_revenue'] = 0;

        foreach ($data->data as $datas) {
            $quantities['totaltickets'] += 1;
            if ($datas->status == 'Confirmed') {
                $quantities['confirmedtickets'] += 1;
                $quantities['total_revenue'] += $datas->price;
            }
            if ($datas->status == 'Cancelled') {
                $quantities['cancelledtickets'] += 1;
            }
        }

        return view('navbar')
            . view('alltickets', ['tickets' => $data->data, 'quantities' => $quantities]);
    }

    public function cancelTicket($id)
    {
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->patch('cancel-ticket/' . $id);

        $data = json_decode($response->getBody());

        return redirect()->to('ticket/' . $id)->with('cancellationSuccess', 'Your Ticket Cancelled Succesfully!');
    }

    public function downloadpdf($id)
    {
        $dompdf = new Dompdf();

        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->get('get-ticket/' . $id);

        $data = json_decode($response->getBody());

        $html = view('ticket', ['ticket' => $data->data]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'Landscape');
        $dompdf->render();
        $dompdf->stream($data->data->movieName, ['Attachment' => false]);

    }

    public function userspecificseats($id)
    {
        $client = service('curlrequest', [
            'baseURI' => 'http://localhost:4000/',
        ]);

        $response = $client->get('usertickets/' . $id);

        $data = json_decode($response->getBody());

        foreach($data->data as $datas){
            echo $datas->movieName . "<br>";
        }
    }

    public function unauthorized()
    {
        return view('navbar')
            . view('unauthorized');
    }
}
