<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tavolsag;
use Illuminate\Support\Facades\Validator;


class UHSzenzorController extends Controller
{
    public function index(){
        $tavolsagok = Tavolsag::paginate(10);
        return view('uhszenzor',['tavolsagok' => $tavolsagok]);
    }

    public function create(Request $req){
        $validalas = Validator::make(
            $req->all(),
            [
                "tavolsag" => "required",
            ],
            [
                "tavolsag.required" => "Hiányzó távolság",
            ]
        );

        if($validalas->fails()){
            $data['message'] = "Hibás adatok";  
            $data['errorList'] = $validalas->messages();
            return response()->json($data,400);
        }else{
            //Adatabázisba szúrni az adatokat
            $tavolsag = new Tavolsag;
            $tavolsag->tavolsag = $req->input('tavolsag');
            $tavolsag->meres_ideje = date('Y-m-d H:i:s');
            $tavolsag->save();
            return response()->json($tavolsag,201);
        }
    }
}
