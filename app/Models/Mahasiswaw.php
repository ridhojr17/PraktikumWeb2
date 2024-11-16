<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswaw extends Model
{
    use HasFactory;

    protected $table = 'mahasiswaws';

    protected $guarded = [
        'id',
    ];
}
