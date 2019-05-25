<?php

namespace App\Service;



use App\Http\Requests\StoreIngredient;
use App\Recipe;
use Illuminate\Support\Facades\Log;

class RecipeService
{
    /**
     * @param StoreIngredient $request
     * @return bool
     */
    public function save($request)
    {
        try {
            $recipe = Recipe::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $array = [];

            if ($request->ingredient_list ?? false) {
                foreach ($request->ingredient_list as $item) {
                    $array[$item['selected']] = ['amount' => $item['amount']];
                }

                $recipe->ingredients()->sync($array);
            }

            return true;

        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }

    }

    /**
     * @param StoreIngredient $request
     * @param $recipe
     * @return bool
     */
    public function update($request, $recipe)
    {
        try {
            $recipe->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $array = [];

            if ($request->ingredient_list ?? false) {
                foreach ($request->ingredient_list as $item) {
                    $array[$item['selected']] = ['amount' => $item['amount']];
                }

                $recipe->ingredients()->sync($array);
            }

            return true;

        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }

    }
}
