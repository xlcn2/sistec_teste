<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/teste/{p1}/{p2}','TesteController@teste')->name('app.teste');    
  
Route::prefix('/app')->group(function(){
Route::get('/', 'PrincipalController@index'); 



//CRUD Clientes   
    
Route::resource('/clientes', 'ClienteController'); 
    
Route::delete('/cliente/{cliente}', 'ClienteController@delete')->name('cliente.delete');
    
Route::patch('/cliente/edit/{cliente}', 'ClienteController@update')->name('cliente.update');
    
Route::get('/compras/{cliente}', 'ClienteController@compras_cliente')->name('cliente.compras');
    
//CRUD produtos   
    
Route::resource('/produtos', 'ProdutoController'); 
    
Route::delete('/produto/{produto}', '   ProdutoController@delete')->name('produto.delete');
    
Route::patch('/produto/edit/{produto}', 'ProdutoController@update')->name('produto.update');
    
    
});


/*
 Route::get(URL, Ação(função de callback) );
*/