<?php

//Rotas relacionadas ao site comercial

Route::get('/', 'SiteController@index')
    ->name('site.index');

Route::post('busca', 'SiteController@pesquisa')
    ->name('site.pesq');

Route::get('proposta/{id}', 'SiteController@formPropostas')
    ->name('site.proposta');

Route::post('cadproposta/{id}', 'SiteController@proposta')
        ->name('site.prop');





//Rotas relacionada a parte interna do sistema. Obs: caminho admin é usado para obrigar ao usuário estar logado como administrador
Route::resource('admin/carros', 'CarroController');

Route::resource('admin/marcas', 'MarcaController');

Route::get('admin/carrosfoto/{id}', 'CarroController@foto')
        ->name('carros.foto');

Route::post('admin/carrosfotostore', 'CarroController@storefoto')
        ->name('carros.storefoto');

Route::post('admin/destaqueveiculo/{id}', 'CarroController@destaque')
        ->name('carros.destaque');

Auth::routes();

Route::get('/admin', 'HomeController@index');

Route::get('admin/carrosgraf', 'CarroController@graf')
        ->name('carros.graf');

Route::get('admin/relatorios', 'CarroController@relatorio')
    ->name('vendas.rel');

Route::get('admin/mensagem/{id}', 'CarroController@mensagemEmail')
    ->name('vendas.mensagem');

Route::get('admin/enviomensagem', 'CarroController@enviaMensagem');

Route::get('admin/relatoriopropostas', 'CarroController@grafProposta')
    ->name('carros.grafprop');

Route::get('carrospesq', 'CarroController@pesq')
    ->name('carros.pesq');


Route::post('carrosfiltro', 'CarroController@filtro')
    ->name('carros.filtro');


Route::get('/register', function (){
 return "<h2>Acesso Negado</h2>";
});