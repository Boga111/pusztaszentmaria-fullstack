    @extends('layout')
    @section('content')
    <div class="col-md-9">
        <h1 class="text-center py-3">Regisztráció</h1>
        <div class="card w-50 mx-auto">
            <form class="card-body" action="/reg" method="post">
                @csrf
                <label class="form-label" for="nev">Név: </label>
                <input class="form-control @error('nev') is-invalid @enderror" type="text" name="nev" id="nev" value="{{old('nev')}}">
                @error('nev')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

                <label class="form-label mt-3" for="email">E-mail cím: </label>
                <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email" value="{{old('email')}}">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                
                <label class="form-label mt-3" for="password">Jelszó: </label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password">
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                
                <label class="form-label mt-3" for="password_confirmation">Jelszó újra: </label>
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation">
                @error('password_confirmation')
                    <p class="text-danger">{{ $message }}</p>
                @enderror

                <button class="btn btn-primary mt-4" type="submit">Regisztrálok</button>
            </form>
        </div>
    </div>
    @endsection