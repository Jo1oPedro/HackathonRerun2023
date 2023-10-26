<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
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


}