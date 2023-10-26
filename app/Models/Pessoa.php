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


	public function pessoafisica()
	{
		return $this->hasOne(PessoaFisica::class);
	}
	public function pessoajuridica()
	{
		return $this->hasOne(PessoaJuridica::class);
	}
}