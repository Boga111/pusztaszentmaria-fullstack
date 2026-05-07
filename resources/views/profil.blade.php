@extends('layout')
@section('content')
<div class="col-md-9">
    @if(session('siker'))
        <div class="alert alert-success mt-3">
            {{ session('siker') }}
        </div>
    @endif
    <h1 class="text-center py-3">Profil</h1>
    @if(Auth::user()->permission == 'a')
        <p> היי {{ Auth::user()->nev }}! </p>
    @else
        <p> Szia {{ Auth::user()->nev }}! </p>
    @endif
    <p>E-mail: <a href="mailto:{{Auth::user()->email}}">{{Auth::user()->email}}</a></p>
    <p>Regisztráció dátuma: {{ date_format(date_create(Auth::user()->created_at), "Y. m. d. H:i") }}</p>
    <p>
        <a class="btn btn-primary" href="/newpass">Jelszó módosítás</a>
        <a class="btn btn-primary" href="/logout">Kilépés</a>
    </p>
</div>
@endsection