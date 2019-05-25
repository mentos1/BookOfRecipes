<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIngredient;
use App\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::select('id', 'name')->get();

        return view('pages.ingredient.show_ingredients', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.ingredient.create_ingredient');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreIngredient $request
     * @return void
     */
    public function store(StoreIngredient $request)
    {
        Ingredient::create(['name' => $request->ingredient]);

        return back()->with(['success' => 'Ингридиент добавлен']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredient $ingredient)
    {
        return view('pages.ingredient.edit_ingredient' , compact('ingredient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $ingredient->update(['name' => $request->ingredient]);

        return back()->with(['success' => 'Ингридиент обновлен']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ingredient $ingredient
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return back()->with(['success' => 'Ингридиент удален']);
    }
}
