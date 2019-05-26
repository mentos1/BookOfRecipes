@extends('home')


@section('main_block')
    <show-recipe
            store_recipe_action = "{{ route('recipes.update', $recipe->id)  }}"
            recipe ='{{ $recipe }}'
            recipe_ingredients ='{{ $recipe->ingredients }}'
    ></show-recipe>
{{--    <div class="container">
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
                        <div><input value="{{$ingredient->pivot->amount}}" onblur="console.log(this.value)"></div>
                    </div>
                @endforeach

            </div>
        </div>--}}
@endsection
