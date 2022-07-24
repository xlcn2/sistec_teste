<?php

namespace App\Http\Controllers;
use App\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
           $produtos = produto::all();
           return view ('app/produto')->with('produtos', $produtos);
          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request){
   
          $valor = $request->valor;
        $source = array('.', ',');
        $replace = array('', '.');
        $valor_float = str_replace($source, $replace, $valor);
         
       produto::create([
         'nome' => $request->nome,
         'valor' => $valor_float,
         'detalhes' => $request->detalhes
              
      ]);
        
      
    $this->meesage('message','Salvo Com Sucesso');
   
        return redirect('app/produtos')->with('flash_message', 'produto Salvo com sucesso.');
    }

    public function update(Request $request, Produto $produto){
        
        $valor = $request->valor;
        $source = array('.', ',');
        $replace = array('', '.');
        $valor_float = str_replace($source, $replace, $valor);
        $produto->update([
                    'nome' => $request->nome,
                    'detalhes' =>  $request->detalhes,
                    'valor' =>  $valor_float
                ]);
          $this->meesage('message','produto Atualizado');
        return redirect('app/produtos')->with('flash_message', 'produto atualizado!');  
    }
 
  
    public function delete(Produto $produto){
      $produto->delete();
      $this->meesage('message','produto Excluido');
        
        return redirect('app/produtos')->with('flash_message', 'produto excluido.');
    }
    
     public function meesage(string $name = null, string $message = null){
        return session()->flash($name,$message);
    }
}
