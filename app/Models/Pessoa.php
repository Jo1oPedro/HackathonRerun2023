<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function endereco()
	{
		return $this->hasOne(Endereco::class);
	}
	
}
