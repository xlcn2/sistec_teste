<?php

namespace App\Http\Controllers;
use App\Cliente;
use App\Produto;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function index(){
        $clientes = Cliente::all();
        $produtos = Produto::all();
           return view ('app.index')->with('clientes', $clientes)->with('produtos', $produtos);
          
    }
}
