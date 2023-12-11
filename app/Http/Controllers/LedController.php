<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LedController extends Controller
{
    public function index(){

        return view('ledkapcsolo');
    }

    public function ledsenddata(Request $req){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,"http://192.168.12.20/ledkapcsolas");
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $data = [
            "red" => $req->input('red'),
            "green" => $req->input('green'),
            "blue" => $req->input('blue'),   
        ];
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);

        $response = curl_exec($ch);

        curl_close($ch);

        return response()->json($response);
    }
}
