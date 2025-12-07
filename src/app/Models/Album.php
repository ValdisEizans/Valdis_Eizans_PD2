<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Album extends Model
{
	protected $fillable = [
		'name',
		'author_id',
		'description',
		'price',
		'year',
	];

    public function author(): BelongsTo
	{
	 return $this->belongsTo(Author::class);
	}
	
	public function genre(): BelongsTo
	{
	 return $this->belongsTo(Genre::class);
	}

}
