<?php

namespace App\Models;

use Database\Factories\WaitlistSignupFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaitlistSignup extends Model
{
    /** @use HasFactory<WaitlistSignupFactory> */
    use HasFactory;

    protected $fillable = [
        'email',
    ];
}
