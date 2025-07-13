<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UuidGenerator;

class Division extends Model
{
    use UuidGenerator;

    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = ['name'];
}
