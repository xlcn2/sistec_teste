<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
      public $timestamps = false;
    
    protected $table = 'produto';
    protected $primaryKey = 'id';
    protected $fillable = ['nome', 'valor', 'detalhes'];
    
    public function getRouteKeyName()
	{
		return 'id';
	}
     
    
     public function clientes() 
    { 
        return $this->belongsToMany('App\Cliente'); 
    } 
}
