<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'name',
    ];

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class)
            ->withPivot('amount');
    }
}
