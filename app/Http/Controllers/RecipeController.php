<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipe;
use App\Ingredient;
use App\Recipe;
use App\Service\RecipeService;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * @var RecipeService
     */
    private $recipeService;

    /**
     * RecipeController constructor.
     * @param RecipeService $recipeService
     */
    public function __construct(RecipeService $recipeService)
    {
        $this->recipeService = $recipeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::select('id', 'name', 'description')->get();

        return view('pages.recipe.show_recipes', compact('recipes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ingredients = Ingredient::select('id', 'name')->get();

        return view('pages.recipe.create_recipe', compact('ingredients'));
    }

    /**
     * @param StoreRecipe $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRecipe $request)
    {
        if ($this->recipeService->save($request)) {
            return response()->json(['status' => 'ok']);
        } else{
            return response()->json(['status' => 'err']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        return view('pages.recipe.show_recipe', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        $ingredients = Ingredient::select('id', 'name')->get();
        $recipe = $recipe->where('id', $recipe->id)->get(['id', 'name', 'description'])->first();

        return view('pages.recipe.edit_recipe' , compact('recipe', 'ingredients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        if ($this->recipeService->update($request, $recipe)) {
            return response()->json(['status' => 'ok']);
        } else{
            return response()->json(['status' => 'err']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipe $recipe
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return back()->with(['success' => 'Рецепт удален']);
    }
}
