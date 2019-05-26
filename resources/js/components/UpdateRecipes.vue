<template>
    <div class="container">

        <div class="card-body">
            <div class="content">
                <h3>Редактирование рецепта</h3>

                <div>
                    <form @submit="submit">
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Название</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" placeholder="name"
                                       v-model="name">
                                <div v-if="error_name">Заполните название</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Описание</label>
                            <div class="col-sm-10">
                                <textarea rows="5" class="form-control" name="description" id="description"
                                          placeholder="Описание" v-model="description"></textarea>
                                <div v-if="error_description">Заполните описание</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <h6>Ингридиенты</h6>
                            </div>
                            <div class="col-sm-6">
                                <h6>Количество</h6>
                            </div>
                        </div>

                        <section>
                            <div v-for="(item, index) in ingredient_list" :key="item.id">
                                <div class="row content_item" v-if="index !== ingredient_list.length - 1">
                                    <div class="col-sm-6">
                                        <div>
                                            <select class="custom-select" v-model="item.selected" disabled>
                                                <option :key="ingredient.id"
                                                        v-for="ingredient in ingredients"
                                                        v-bind:value="ingredient.id"
                                                >{{ ingredient.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <input type="text" class="form-control col-sm-10" v-model="item.amount"
                                                   disabled>
                                            <img src="/open-iconic/svg/x.svg" class="col-sm-2"
                                                 v-on:click="remove(index)">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" v-else>
                                    <div class="col-sm-6">
                                        <div>
                                            <section v-if="ingredient_filtered.length">
                                                <select class="custom-select" v-model="item.selected">
                                                    <option :key="ingredient.id"
                                                            v-for="ingredient in ingredient_filtered"
                                                            v-bind:value="ingredient.id"
                                                    >{{ ingredient.name }}
                                                    </option>
                                                </select>
                                            </section>
                                            <section v-else>
                                                <select class="custom-select" v-model="item.selected">
                                                    <option :key="ingredient.id"
                                                            v-for="ingredient in ingredients"
                                                            v-bind:value="ingredient.id"
                                                    >{{ ingredient.name }}
                                                    </option>
                                                </select>
                                            </section>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <input type="text" class="form-control col-sm-10" v-model="item.amount">
                                            <img src="/open-iconic/svg/x.svg" class="col-sm-2"
                                                 v-on:click="remove(index)">
                                        </div>
                                    </div>
                                    <div v-if="error_last_ingredient">Заполните все</div>
                                </div>
                            </div>
                        </section>


                        <div class="row control_buttons">
                            <div class="col-sm-3">
                                <button type="button" v-on:click="add"
                                        v-bind:disabled="ingredient_list.length >= ingredients.length">Добавить
                                </button>
                            </div>
                            <div class="col-sm-8 offset-md-1 row">
                                <label class="col-sm-4">Нет в списке?</label>
                                <button type="button" class="col-sm-8" data-toggle="modal" data-target="#exampleModal">
                                    Создать новый ингредиент
                                </button>
                            </div>
                        </div>
                        <hr>
                        <button type='submit' class="col-sm-8">
                            Сохраните рецепт
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['ingredients', 'store_recipe_action', 'recipe', 'recipe_ingredients'],
        data() {
            return {
                ingredient_filtered: [],

                ingredient_list: [{
                    selected: 0,
                    amount: ''
                }],
                error_last_ingredient: false,
                name: '',
                error_name: false,
                description: '',
                error_description: false,

            }

        },
        methods: {
            add() {
                let last_ingredient = this.ingredient_list[this.ingredient_list.length - 1];

                if (last_ingredient.selected === 0 || last_ingredient.amount === '') {
                    this.error_last_ingredient = true;
                    return
                } else {
                    this.error_last_ingredient = false;
                }

                if (this.ingredient_list.length < this.ingredients.length) {
                    this.ingredient_list = [...this.ingredient_list, {
                        selected: null,
                        amount: ''
                    }];

                    this.filter_items();
                }
            },
            remove(id) {
                if (this.ingredient_list.length > 1) {
                    this.ingredient_list = this.ingredient_list.filter((item, key) => key !== id);
                }

                this.filter_items();
            },
            filter_items() {
                let list = [...this.ingredient_list];
                list.pop();
                let id_busy_ingredients = list.map((item) => item.selected);
                this.ingredient_filtered = this.ingredients.filter((item) => {
                    return !(id_busy_ingredients.indexOf(item.id) + 1)
                });
            },
            submit(e) {
                e.preventDefault();

                if (this.name === '') {
                    this.error_name = true;
                } else {
                    this.error_name = false;
                }

                if (this.description === '') {
                    this.error_description = true;
                } else {
                    this.error_description = false;
                }

                axios.put(this.store_recipe_action, {
                    name: this.name,
                    description: this.description,
                    ingredient_list: this.ingredient_list,
                }).then(function (response) {
                    if (response.status === 200 && response.data.status === 'ok') {
                        window.location.href = '/home'
                    }
                }).catch(function (error) {
                    console.error(error);
                });


            }

        },
        mounted() {
            let ingredients = JSON.parse(this.ingredients),
                recipe = JSON.parse(this.recipe),
                recipe_ingredients = JSON.parse(this.recipe_ingredients);

            this.ingredients = JSON.parse(this.ingredients);
            this.recipe = JSON.parse(this.recipe);
            this.recipe_ingredients = JSON.parse(this.recipe_ingredients);

            this.name = recipe.name;
            this.description = recipe.description;
            this.ingredient_filtered = [...ingredients];

            this.ingredient_list = recipe_ingredients.map((item) => {
                return {selected: item.id, amount: item.pivot.amount}
            });


            this.filter_items();

        }
    }
</script>
