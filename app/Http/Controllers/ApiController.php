<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(){
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.coindesk.com/v1/bpi/currentprice.json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $decoded = json_decode($response, true);
            $data = $decoded['bpi']["USD"]["rate"];
            return view('home',['data'=>$data]);
        }
    }

}
