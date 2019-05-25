@extends('home')


@section('main_block')
    <div class="container">
        <div class="card-body">
            <div class="content">
                <div class="d-flex justify-content-between">
                    <h3>Мои рецепты</h3>
                    <a href="{{route('recipes.create')}}" class="btn btn-primary" style="height: 40px">Добавить
                        рецерт</a>
                </div>
                <table>
                    <tr class="row">
                        <th class="col-3">Рецерты</th>
                        <th class="col-6">Описание</th>
                        <th class="col-3">Действия</th>
                    </tr>
                    @foreach($recipes as $recipe)
                        <tr class="row ">
                            <td class="col-3">{{$recipe->name}}</td>
                            <td class="col-6">{{$recipe->description}}</td>
                            <td class="col-3">
                                <div class="d-flex justify-content-between">
                                    <a href="{{route('recipes.show', ['id' => $recipe->id])}}" class="btn btn-info">
                                        <img src="/open-iconic/svg/eye.svg">
                                    </a>

                                    <a href="{{route('recipes.edit', ['id' => $recipe->id])}}" class="btn btn-info">
                                        <img src="/open-iconic/svg/pencil.svg">
                                    </a>
                                    <form method="post" action="{!! route('recipes.destroy', $recipe->id)  !!}">
                                        {{ csrf_field() }}
                                        {{method_field ('DELETE')}}
                                        <button type="submit" class="btn btn-danger">
                                            <img src="/open-iconic/svg/x.svg">
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
