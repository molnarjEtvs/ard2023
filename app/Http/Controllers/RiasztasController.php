<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiasztasController extends Controller
{
    public function index(){
        return view('riasztaskapcsolo');
    }

    public function alertsenddata(Request $req){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,"http://192.168.12.20/riasztas");
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $data = [
            "allapot" => $req->input('allapot')  
        ];
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);

        $response = curl_exec($ch);

        curl_close($ch);

        return response()->json($response);
    }

}
