@extends('home')

@section('script')

@endsection

@section('main_block')
    <create-recipes
            ingredients={{ $ingredients }}
            store_recipe_action="{{ route('recipes.store') }}"
    ></create-recipes>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавление ингридиента</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{ route('ingredients.store') }}" >
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="ingredient" class="col-sm-4 col-form-label">Название</label>
                            <div class="col-sm-8">
                                <input type="text" id="ingredient" class="form-control" name="ingredient" placeholder="Помидор">
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
@endsection
