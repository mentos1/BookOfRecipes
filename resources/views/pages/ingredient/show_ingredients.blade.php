@extends('home')

@section('main_block')
    <div class="container">
        <div class="card-body">
            <div class="content">
                <div class="d-flex justify-content-between">
                    <h3>Мои Ингридиент</h3>
                    <a href="{{route('ingredients.create')}}" class="btn btn-primary" style="height: 40px">Добавить ингридиент</a>
                </div>
                <table>
                    <tr class="row">
                        <th class="col-10">Рецерты</th>
                        <th class="col-2">Действия</th>
                    </tr>
                    @foreach($ingredients as $ingredient)
                        <tr class="row ">
                            <td class="col-10">{{$ingredient->name}}</td>
                            <td class="col-2">
                                <div class="d-flex justify-content-between">
                                    <a href="{{route('ingredients.edit', ['id' => $ingredient->id])}}" class="btn btn-info" >
                                        <img src="/open-iconic/svg/pencil.svg" >
                                    </a>
                                    <form method="post" action="{!! route('ingredients.destroy', $ingredient->id)  !!}">
                                        {{ csrf_field() }}
                                        {{method_field ('DELETE')}}
                                        <button type="submit" class="btn btn-danger">
                                            <img src="/open-iconic/svg/x.svg" >
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
