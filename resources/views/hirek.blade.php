        @extends('layout')
        @section('content')
        <div class="col-md-9">
            <h1 class="text-center py-3">Hírek</h1>
            @foreach ($result as $row)
                <h2>{{$row->title}}</h2>
                <div class="row">
                    <div class="col-md-8">
                        <p>
                            {{ date_format(date_create($row->date), 'Y. m. d.') }}
                        </p>
                        <p>{!! $row->text !!}</p>
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('img/'.$row->img) }}" alt="{{$row->img}}" class="w-100">
                    </div>
                </div>
                <hr>
            @endforeach
        </div>
        @endsection