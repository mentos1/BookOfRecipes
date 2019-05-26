<template>
    <div class="container">
        <div class="card-body">
            <div class="content">
                <div class="d-flex justify-content-between">
                    <h3>{{name}} <img src="/open-iconic/svg/pencil.svg"></h3>
                </div>
                <div class="d-flex justify-content-between description">
                    {{description}}
                </div>
                <h5>Ингридиенты</h5>
                <div class="d-flex justify-content-between div_border_bottom" v-for="ingredient in form.ingredient_list">
                    <div>{{ingredient.name}}</div>
                    <div><input v-model="ingredient.amount" @blur="blurSubmit"></div>
                </div>

            </div>
        </div>
        <div class="alert alert-success" v-if='show_alert_success'>
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Success! </strong>
            Количество было обновлено.
        </div>

        <div class="alert alert-error" v-if='show_alert_error'>
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Success! </strong>
            Ошибка обновления.
        </div>

        <div class="alert alert-warning" v-if='show_alert_warning'>
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>Warning! </strong>
            Неоставляйте поле количество пустым
        </div>
    </div>

</template>

<script>
    export default {
        props: ['store_recipe_action', 'recipe', 'recipe_ingredients'],
        data() {
            return {
                ingredient_list: [{
                    name: '',
                    selected: 0,
                    amount: ''
                }],
                name: '',
                description: '',
                show_alert_success: false,
                show_alert_error: false,
                show_alert_warning: false,
                form: {
                    recipe: {},
                    recipe_ingredients: {},
                    ingredient_list: {}
                }

            }

        },
        methods: {
            blurSubmit() {
                let is_valid = true;
                this.form.ingredient_list.map((item) => {
                    if (item.amount === '') {
                        is_valid = false;
                        this.show_alert_warning = true;
                        setTimeout(() => this.show_alert_warning = false, 1000 * 3);
                    }
                });

                if (is_valid) {
                    axios.put(this.store_recipe_action, {
                        name: this.name,
                        description: this.description,
                        ingredient_list: this.form.ingredient_list,
                    }).then((response) => {
                        if (response.status === 200 && response.data.status === 'ok') {
                            this.show_alert_success = true;
                            setTimeout(() => this.show_alert_success = false, 1000 * 3);
                        } else {
                            this.show_alert_error = true;
                            setTimeout(() => this.show_alert_error = false, 1000 * 3);
                        }
                    }).catch((error) => {
                        this.show_alert_error = true;
                        setTimeout(() => this.show_alert_error = false, 1000 * 3);
                        console.error(error);
                    });
                }

            }

        },
        mounted() {
            let recipe = JSON.parse(this.recipe),
                recipe_ingredients = JSON.parse(this.recipe_ingredients);


            this.name = recipe.name;
            this.description = recipe.description;

            this.form.recipe = recipe;
            this.form.recipe_ingredients = recipe_ingredients;
            this.form.ingredient_list = recipe_ingredients.map((item) => {
                return {
                    name: item.name,
                    selected: item.id,
                    amount: item.pivot.amount
                }
            });

        }
    }
</script>
