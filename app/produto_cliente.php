<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto_cliente extends Model
{
    public $timestamps = false;
    protected $table = 'produto_cliente';
    protected $primaryKey = 'id';
    protected $fillable = ['id_produto', 'id_cliente'];
    
    public function getRouteKeyName()
	{
		return 'id';
	}
}
