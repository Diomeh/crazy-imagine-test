<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // When type hinting model properties things will fail with
    // `Typed property must '' not be accessed before initialization` if props are not set with default values
    // Thing is, when set with default values the actual model data is lost and replaced with those, and I'm not clear why
    // for now, i'll omit model's type hints

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
    ];
}
