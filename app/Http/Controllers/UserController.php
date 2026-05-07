<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;		//Jelszókezeléshez
use Illuminate\Support\Facades\Hash;			//Hash készítéshez
use Illuminate\Support\Facades\Auth;			//Autentikációhoz
use App\Models\User;

class UserController extends Controller
{
    public function Reg(){
        if(Auth::check()){
            return redirect('/');
        } else {
            return view('reg');
        }
    }

    public function RegButton(Request $req){
        $req->validate([
            'nev'                       => 'required|min:3|max:255',
            'email'                     => 'required|email|unique:User,email',
            'password'                  => ['required', 'confirmed', 
                                            Password::min(8)->letters()->numbers()->mixedCase()->symbols()->uncompromised()],
            'password_confirmation'     => 'required'
        ],[
            '*.required'                => 'Kérem töltse ki ezt a mezőt!',
            'email.email'               => 'Nem érvényes e-mail címet adott meg!',       #Csak @-ot ellenőriz
            'email.unique'              => 'Ezzel az e-mail címmel már regisztráltak!',
            'nev.min'                   => 'Legalább három karaktert adjon meg!',
            'nev.max'                   => 'Túl hosszú a neve! Kérem válasszon rövidebbet!',
            'password.confirmed'        => 'A két jelszó nem egyezik meg!',
            'password.min'              => 'A jelszó legalább 8 karakter legyen!',
            'password.letters'          => 'A jelszó legalább 1 betűt tartalmazzon!',
            'password.numbers'          => 'A jelszó legalább 1 számot tartalmazzon!',
            'password.mixed'            => 'A jelszó tartalmazzon kis- és nagybetűt is!',
            'password.symbols'          => 'A jelszó tartalmazzon speciális karaktert is!',
            'password.uncompromised'    => 'Ez a jelszó kiszivárgott egy adatvédelmi incidens során, kérem válasszon egy másikat!'
        ]);

        $data           = new User;
        $data->nev      = $req->nev;
        $data->email    = $req->email;
        $data->password = $req->password;
        $data->Save();
        return redirect('/login')->with([ 'siker' => 'Sikeresen regisztrált!' ]);
    }

    public function Login(){
        if(Auth::check()){
            return redirect('/profil');
        } else{
            return view('login');
        }
    }

    public function LoginButton(Request $req){
        $req->validate([
            'email'     => 'required',
            'password'  => 'required'
        ],[
            '*.required' => 'Kérem töltse ki ezt a mezőt!',
        ]);
        if(Auth::attempt(['email' => $req->email, 'password' => $req->password])){
            return redirect('/profil')->with([
                'siker' => 'Sikeresen belépett a(z) '.Auth::user()->nev.' felhasználóval!'
            ]);
        } else {
            return redirect('/login')->with([
                'kudarc' => 'Hibás e-mail cím vagy jelszó!'
            ]);
        }

    }

    public function Profil(){
        if(Auth::check()){
            return view('profil');
        } else {
            return redirect('/login');
        }
    }

    public function Logout(){
        Auth::logout();
        return redirect('/login');
    }

    public function Newpass(){
        if(Auth::check()){
            return view('newpass');
        } else {
            return redirect('/login');
        }
    }

    public function NewpassButton(Request $req){
        $req->validate([
            'oldpassword'               => 'required',
            'password'                  => ['required', 'confirmed', 
                                            Password::min(8)->letters()->numbers()->mixedCase()->symbols()->uncompromised()],
            'password_confirmation'     => 'required'
        ],[
            '*.required'                => 'Kérem töltse ki ezt a mezőt!',
            'password.confirmed'        => 'A két jelszó nem egyezik meg!',
            'password.min'              => 'A jelszó legalább 8 karakter legyen!',
            'password.letters'          => 'A jelszó legalább 1 betűt tartalmazzon!',
            'password.numbers'          => 'A jelszó legalább 1 számot tartalmazzon!',
            'password.mixed'            => 'A jelszó tartalmazzon kis- és nagybetűt is!',
            'password.symbols'          => 'A jelszó tartalmazzon speciális karaktert is!',
            'password.uncompromised'    => 'Ez a jelszó kiszivárgott egy adatvédelmi incidens során, kérem válasszon egy másikat!'
        ]);

        if(Hash::check($req->oldpassword, Auth::user()->password)){
            if($req->oldpassword == $req->password){
                return redirect('/newpass')->with([
                    'kudarc' => 'A régi és az új jelszava nem egyezhet meg!'
                ]);
            } else {
                $data           = User::find(Auth::user()->user_id);
                $data->password = $req->password;
                $data->Save();
                Auth::logout();
                return redirect('/login')->with([
                    'siker' => 'A jelszava sikeresen megváltozott! Kérem lépjem be újra!'
                ]);
            }
        } else {
            return redirect('/newpass')->with([
                'kudarc' => 'A régi jelszava nem megfelelő, kérem próbálja meg újra!'
            ]);
        }
    }
}
