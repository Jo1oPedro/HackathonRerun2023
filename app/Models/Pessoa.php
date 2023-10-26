<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    use HasFactory;

    protected $guarded = [];



	public function aluno()
	{
		return $this->hasOne(Aluno::class);
	}
	public function professor()
	{
		return $this->hasOne(Professor::class);
	}
}