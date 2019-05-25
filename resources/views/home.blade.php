@extends('layouts.app')

@yield('script')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card ">
                <div class="card-header">Меню</div>
                <div  class="row justify-content-center btn-bottom_border">
                    <img src="/open-iconic/svg/book.svg" >
                    <a href="{{route('home')}}" class="btn" >Мои Рецепты</a>
                </div>
                <div  class="row justify-content-center">
                    <img src="/open-iconic/svg/puzzle-piece.svg" >
                    <a href="{{route('ingredients.index')}}" class="btn">Ингридиенты</a>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Содержание</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                     @yield('main_block')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
