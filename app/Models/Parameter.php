<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Parameter extends Model
{
    use HasFactory;

    // En el modelo Parameter
    protected $fillable = [
        'user_id', 'promotion', 'regular', 'free', 'classes'
    ];


    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
