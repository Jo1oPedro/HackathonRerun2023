<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PessoaFisica extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function pessoa()
	{
		return $this->belongsTo(Pessoa::class);
	}
	
}
