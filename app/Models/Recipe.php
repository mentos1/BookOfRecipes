<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
    ];


    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class)
            ->withPivot('amount');
    }
}
