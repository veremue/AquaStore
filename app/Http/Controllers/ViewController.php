<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        //get the list by API Call
        $method = 'show_aquaria';

        $data = [
            "id" => $id,
            "method" => $method,
        ];

        $encodedData = json_encode($data);
        $acquaria = $this->getData($encodedData);

        $fish_types = array('Bass',
            'Bluefish',
            'Buffalo Fish',
            'Butterfish',
            'Calamari',
            'Carp',
            'Catfish',
            'Chilean sea bass',
            'Flounder',
            'Golden Snapper',
            'Goldfish',
            'Guppies',
            'Grouper',
            'Whitefish',
            'Whiting');

        return view('show',[
            'acquaria'=>$acquaria,
            'fish_types'=>$fish_types
        ]);
    }

    public function getData($encodedData)
    {

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost/AquaStoreAPI/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => $encodedData,
            CURLOPT_HTTPHEADER => array(
                'x-access-token: '.Auth::user()->access_token,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response);
    }
}
