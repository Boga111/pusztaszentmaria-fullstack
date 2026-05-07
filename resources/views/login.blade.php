    @extends('layout')
    @section('content')
    <div class="col-md-9">
        @if(session('siker'))
            <div class="alert alert-success mt-3">
                {{ session('siker') }}
            </div>
        @endif
        @if(session('kudarc'))
            <div class="alert alert-danger mt-3">
                {{ session('kudarc') }}
            </div>
        @endif
        <h1 class="text-center py-3">Belépés</h1>
        <div class="card w-50 mx-auto">
            <form class="card-body" action="/login" method="post">
                @csrf
                
                <label class="form-label" for="email">E-mail cím: </label>
                <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                
                <label class="form-label mt-3" for="password">Jelszó: </label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password">
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                
                <button class="btn btn-primary mt-4" type="submit">Belépés</button>
            </form>
        </div>
    </div>
    @endsection