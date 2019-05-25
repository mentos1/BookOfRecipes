@extends('home')


@section('main_block')
    <div class="container">
        <div class="card-body">
            <div class="content">
                <div class="d-flex justify-content-between">
                    <h3>{{$recipe->name}} <img src="/open-iconic/svg/pencil.svg"></h3>
                </div>
                <div class="d-flex justify-content-between description">
                    {{$recipe->description}}
                </div>
                <h5>Ингридиенты</h5>
                @foreach($recipe->ingredients as $ingredient)
                    <div class="d-flex justify-content-between div_border_bottom">
                        <div>{{$ingredient->name}}</div>
                        <div>{{$ingredient->pivot->amount}}</div>
                    </div>
                @endforeach

            </div>
        </div>
@endsection
