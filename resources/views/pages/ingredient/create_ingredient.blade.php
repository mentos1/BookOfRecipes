@extends('home')

@section('main_block')
    <div class="container">

        <div class="card-body">
            <div class="content">
                <h3>Добавления Ингридиент</h3>

                <div>
                    <form method="post" action="{{ route('ingredients.store') }}">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group row">
                                <label for="ingredient" class="col-sm-4 col-form-label">Название</label>
                                <div class="col-sm-8">
                                    <input type="text" id="ingredient" class="form-control"   name="ingredient" placeholder="Помидор">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Cохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
