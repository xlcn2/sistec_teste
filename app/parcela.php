<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
     public $timestamps = false;
    
    protected $table = 'parcela';
    protected $primaryKey = 'id';
    protected $fillable = ['id_cliente', 'valor', 'vencimento'];
    
    public function getRouteKeyName()
	{
		return 'id';
	}
}
