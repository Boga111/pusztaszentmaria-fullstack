@extends('layout')
@section('content')
<div class="col-md-9">
    @if(session('kudarc'))
        <div class="alert alert-danger">{{ session('kudarc') }}</div>
    @endif
    <h1 class="text-center py-3">Jelszó módosítás</h1>
    <div class="card w-50 mx-auto">
        <form class="card-body" action="/newpass" method="post">
            @csrf
            <label class="form-label mt-3" for="oldpassword">Régi jelszó: </label>
            <input class="form-control @error('oldpassword') is-invalid @enderror" type="password" name="oldpassword" id="oldpassword">
            @error('oldpassword')
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

            <button class="btn btn-primary mt-4" type="submit">Jelszó módosítás</button>
        </form>
    </div>
</div>
@endsection