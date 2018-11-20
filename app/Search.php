<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
	public staic function scopeSearch($query, $searchTerm) {
    	return $query->where('color', 'like', '%' .$searchTerm. '%')
                     ->orWhere('price', 'like', '%' .$searchTerm. '%');
    }
}
