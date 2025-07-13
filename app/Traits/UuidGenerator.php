<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UuidGenerator
{
    protected static function bootUuidGenerator()
    {
        static::creating(function ($model) {
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
