<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PCFilial extends Model
{
    use HasFactory;

    protected $table = 'pcfilial';

    protected $primaryKey = 'codigo';
}
