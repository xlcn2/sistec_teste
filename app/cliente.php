<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public $timestamps = false;
    
    protected $table = 'cliente';
    protected $primaryKey = 'id';
    protected $fillable = ['nome', 'endereco' , 'cpf' , 'qtd_parcelas'];
    
    public function getRouteKeyName()
	{
		return 'id';
	}
    
    //relação de n para n
      public function produtos() 
    { 
        return $this->belongsToMany('App\Produto', 'produto_cliente', 'id_cliente', 'id_produto'); 
    }
    //relação de 1 para n
     public function parcelas()
    {
        return $this->hasMany('App\Parcela', 'id_cliente');
    }
}
