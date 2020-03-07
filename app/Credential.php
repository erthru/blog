<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    protected $fillable = ["level", "email", "password"];

    public function writer()
    {
        return $this->hasOne("App\Writer");
    }
}
