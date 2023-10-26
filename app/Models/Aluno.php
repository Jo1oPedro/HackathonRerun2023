<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $guarded = [];

	public function pessoa()
	{
		return $this->belongsTo(Pessoa::class);
	}
	public function disciplina()
	{
		return $this->hasMany(Disciplina::class);
	}
	public function turma()
	{
		return $this->hasMany(Turma::class);
	}


}