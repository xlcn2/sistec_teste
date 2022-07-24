<?php

namespace App\Http\Controllers;
use App\Cliente;
use App\Produto;
use App\Parcela;
use App\Produto_cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {

        $clientes = Cliente::all();
        $produtos = Produto::all();

        return view ( 'app/cliente' )->with( 'clientes', $clientes )->with( 'produtos', $produtos );

    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {

        //Insere o cliente no banco de dados

        $cliente =   Cliente::create( [
            'nome' => $request->nome,
            'endereco' => $request->endereco,
            'cpf' => $request->cpf,
            'qtd_parcelas' => $request->qtd_parcelas

        ] );

        //Recupera o id e cadastra na tabela produto_cliente

        $valor_total_parcelas = 0;
        $cliente_id = $cliente->id;

        foreach ( $request->produtos as $produto_id ) {
            Produto_cliente::create( [
                'id_produto' => $produto_id,
                'id_cliente' => $cliente_id

            ] );
            //recupera o valor do produto e soma do valor total
            $produto_atual = Produto::find( $produto_id, ['nome', 'valor'] );
            

            $valor_total_parcelas = $valor_total_parcelas + $produto_atual->valor;

        }

        $this->calcula_parcelas( $request->qtd_parcelas, date( 'd/m/Y' ), 30, $cliente_id, $valor_total_parcelas );

        $this->meesage( 'message', 'Salvo Com Sucesso' );

        return redirect( 'app/clientes' )->with( 'flash_message', 'Cliente Salvo com sucesso.' );
    }

    //Função de gerar parcelas 
    
    private function calcula_parcelas( $num_parcelas, $vencimento_primeira_parcela, $intervalo, $id_cliente, $valor_total ) {
        
        if ( $vencimento_primeira_parcela != null ) {
            $vencimento_primeira_parcela = explode( '/', $vencimento_primeira_parcela );
            $dia = $vencimento_primeira_parcela[0];
            $mes = $vencimento_primeira_parcela[1];
            $ano = $vencimento_primeira_parcela[2];
        } else {
            $dia = date( 'd' );
            $mes = date( 'm' );
            $ano = date( 'Y' );
        }

        $valor_parcela = $valor_total / $num_parcelas;

        for ( $parcela = 0; $parcela < $num_parcelas; $parcela++ ) {
            $vencimento = date( 'Y/m/d', strtotime( '+'.( $parcela * $intervalo ). " day", mktime( 0, 0, 0, $mes, $dia, $ano ) ) );

            Parcela::create( [
                'id_cliente' => $id_cliente,
                'vencimento' => $vencimento,
                'valor' => $valor_parcela

            ] );

        }
    }

    //update cliente
    
    public function update( Request $request, Cliente $cliente ) {
        $cliente->update( [
            'nome' => $request->nome,
            'cpf' =>  $request->cpf,
            'endereco' =>  $request->endereco,
            'qtd_parcelas' => $request->qtd_parcelas
        ] );
        
        //remove os registros anteriores
        
        Produto_cliente::where('id_cliente', $cliente->id)->delete();
        
        //Recupera o id e cadastra na tabela produto_cliente

        $valor_total_parcelas = 0;
        $cliente_id = $cliente->id;

        foreach ( $request->produtos as $produto_id ) {
            
            
            Produto_cliente::create( [
                'id_produto' => $produto_id,
                'id_cliente' => $cliente_id

            ] );
            //recupera o valor do produto e soma do valor total
            $produto_atual = Produto::find( $produto_id, ['nome', 'valor'] );
        
            $valor_total_parcelas = $valor_total_parcelas + $produto_atual->valor;

        }
        
          //remove os registros anteriores das parcelas
        
          Parcela::where('id_cliente', $cliente->id)->delete();
        

        $this->calcula_parcelas( $request->qtd_parcelas, date( 'd/m/Y' ), 30, $cliente_id, $valor_total_parcelas );
        
        $this->meesage( 'message', 'Cliente Atualizado' );
        return redirect( 'app/clientes' )->with( 'flash_message', 'cliente atualizado!' );

    }
    
    //delete cliente e seus registros

    public function delete( Cliente $cliente ) {
        
        $cliente->delete();
        Produto_cliente::where('id_cliente', $cliente->id)->delete();
        Parcela::where('id_cliente', $cliente->id)->delete();
        
        $this->meesage( 'message', 'Cliente Excluido' );
        
        return redirect( 'app/clientes' )->with( 'flash_message', 'cliente excluido.' );
    }

    public function meesage( string $name = null, string $message = null ) {
        return session()->flash( $name, $message );
    }
}
