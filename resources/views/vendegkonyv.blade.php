@extends('layout')
@section('content')
<div class="col-md-9">
    @if (session('siker'))
        <div class="alert alert-success"> {{ session('siker') }} </div>
    @endif
    @if (session('kudarc'))
        <div class="alert alert-danger"> {{ session('siker') }} </div>
    @endif
    <h1 class="text-center py-3">Vendegkönyv</h1>
    @auth
    <form action="/vendegkonyv" method="post">
        @csrf
        <label for="nev" class="form-label">Név <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="nev" id="nev" value="{{ old('nev', Auth::user()->nev) }}">

        <label for="email" class="form-label">E-mail <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="email" id="email" value="{{ old('email', Auth::user()->email) }}">

        <label for="message" class="form-label">Üzenet <span class="text-danger">*</span></label>
        <textarea name="message" id="message" class="form-control" rows="10">{{ old('message') }}</textarea>

        <p class="text-danger">* kötelező mező</p>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $hiba)
                    <li><span class="text-danger">{{ $hiba }}</span></li>
                @endforeach
            </ul>
        @endif
        <button type="submit" class="btn btn-primary">Beküld</button>
    </form>


    
    @else
    <p>Kérem alert <a href="/login">lépjen be</a>, hogy hozzá tudjon szólni! </p>
    @endauth
    <hr>
    @foreach ($result as $row)
        <h5>
            {{ $row->nev }} - <a href="mailto:{{ $row->email }}">{{$row->email}}</a>
        </h5>
        <p>{{ date_format(date_create($row->date), 'Y. m. d') }}</p>
        <p>
            {{ $row->message }} <br>
            @if (Auth::check() && Auth::user()->permission == 'a') 
            <a class="link-danger" href="/torles/{{ $row->vendegkonyv_id }}">[moderál]</a>
            
            @endif
        </p>
    @endforeach
</div>
@endsection