<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hirek;
use App\Models\Vendegkonyv;
use Illuminate\Support\Facades\Auth;			//Autentikációhoz

class MariaController extends Controller
{
    public function Hirek(){
        return view('hirek', [
            "result" => Hirek::orderBy('hirek_id', 'DESC')->get()
        ]);
    }

    public function Vendegkonyv(){
        return view('vendegkonyv', [
            "result" => Vendegkonyv::orderBy('vendegkonyv_id', 'DESC')->get()
        ]);
    }

    public function VendegkonyvButton(Request $req){
        $req->validate([
            'nev'               => 'required',
            'email'             => 'required',
            'message'           => 'required|min:10'
        ], [
            'nev.required'      => 'Nem adott meg nevet!',
            'email.required'    => 'Nem adott meg emailt!',
            'message.required'  => 'Nem szólt hozzá!',
            'message.min'       => 'Írjon többet'
        ]);

        $data           = new Vendegkonyv();
        $data->nev      = $req->nev;
        $data->email    = $req->email;
        $data->message  = $req->message;
        $data->date     = date('Y-m-d');

        $data->save();

        return redirect('/vendegkonyv')->with([
            'siker' => "Sikeresen rögzítettük a hozzászólását."
        ]);
    }

    public function Moderalas($id){
        if(Auth::check() && Auth::user()->permission == 'a'){
            $data = Vendegkonyv::find($id);
            $data->delete();
            return redirect('vendegkonyv')->with([
                'siker' => 'Sikeres moderálás!'
            ]);
        } else{
            return redirect('/vendegkonyv')->with([
                'kudarc' => 'Ehhez nincs jogosultsága!'
            ]);
        }
    }
}
