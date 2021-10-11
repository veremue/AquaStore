<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateController extends Controller
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
    public function storeaquaria(Request $request)
    {
        $method = 'create_aquaria';

        $data = [
            "description" => $request->description,
            "glass_type" => $request->glass_type,
            "size" => $request->size,
            "shape" => $request->shape,
            "method" => $method,
            ];

        $encodedData = json_encode($data);

        $this->sendData($encodedData);

        return HomeController::index();
    }

    public function storefish(Request $request)
    {
        $method = 'add_fish';
        $data = [
            "species" => $request->species,
            "color" => $request->color,
            "number_of_fins" => $request->number_of_fins,
            "aquaria_id" => $request->aquaria_id,
            "method" => $method,
        ];

        $encodedData = json_encode($data);

        $response = json_decode($this->sendData($encodedData));

        if($response->result == 'success')
            return redirect()->back()->with('status','Fish added to Aquarium successfully...');
        else
            return redirect()->back()->with('error','Fish added to Aquarium failed...');
    }

    public function updatefish(Request $request)
    {
        $method = 'update_fish';
        $data = [
            "species" => $request->species,
            "color" => $request->color,
            "number_of_fins" => $request->number_of_fins,
            "fish_id" => $request->fish_id,
            "method" => $method,
        ];

        $encodedData = json_encode($data);

        $response = json_decode($this->sendData($encodedData));

        if($response->result == 'success')
            return redirect()->back()->with('status','Fish updated successfully...');
        else
            return redirect()->back()->with('error','Fish update failed...');
    }

    public function removefish($id)
    {
        $method = 'remove_fish';
        $data = [
            "id" => $id,
            "method" => $method,
        ];

        $encodedData = json_encode($data);

        $response = json_decode($this->sendData($encodedData));

        return redirect()->back()->with('status','Fish deleted from Aquarium successfully...');
    }

    public function sendData($encodedData)
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

        return $response;
    }
}
