<?php

namespace Techwasi\Encipher\Tests;

use Illuminate\Database\Eloquent\Model;
use Techwasi\Encipher\Encipher;

class TestPhone extends Model
{
    use Encipher;

    protected $fillable = ['phone_number'];
    protected $encipher = ['phone_number'];

    public function user()
    {
        return $this->belongsTo(TestUser::class);
    }
}