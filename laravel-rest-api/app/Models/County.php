<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\City;
class County extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'img_url'];
    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
