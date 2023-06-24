<?php

namespace Techwasi\Encipher\Tests;

use Illuminate\Database\Eloquent\Model;
use Techwasi\Encipher\Encipher;

class TestUser extends Model
{
    use Encipher;

    protected $fillable = ['email', 'name', 'password'];
    protected $encipher = ['email', 'name'];
    protected $camelcase = ['name'];

    public function phones()
    {
        return $this->hasMany(TestPhone::class);
    }

}