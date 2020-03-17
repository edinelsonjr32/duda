<?php

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

use Illuminate\Support\Facades\DB;



/**Inicio Rotas gerenciamento de autorizacao locação**/
Route::group(['middleware' => ['auth']], function () {
    Route::get('/autorizacao/locacao/index', 'AutorizacaoLocacaoController@index')->name('autorizacao.locacao.index');

    Route::get('/autorizacao/locacao/editor/{id}', 'AutorizacaoLocacaoController@dadosEditor')->name('autorizacao.locacao.editor');

    Route::get('/autorizacao/locacao/show/{id}', 'AutorizacaoLocacaoController@show')->name('autorizacao.locacao.show');

    Route::get('/autorizacao/locacao/edit/{id}', 'AutorizacaoLocacaoController@edit')->name('autorizacao.locacao.edit');

    Route::get('/autorizacao/locacao/download/{id}', 'AutorizacaoLocacaoController@download')->name('autorizacao.locacao.download');

    Route::get('/autorizacao/locacao/download/{id}/file', 'AutorizacaoLocacaoController@downloadFile')->name('autorizacao.locacao.download.file');

    Route::get('/autorizacao/locacao/documento/destroy/{id}', 'AutorizacaoLocacaoController@destroyDocumento')->name('autorizacao.locacao.documento.destroy');

    Route::get('pdf', 'PdfController@index')->name('gerar.pdf');
    Route::post('/autorizacao/locacao/busca_imovel', 'AutorizacaoLocacaoController@buscaImovel')->name('autorizacao.locacao.busca_imovel');

    Route::post('/autorizacao/locacao/finalizar_cadastro', 'AutorizacaoLocacaoController@finalizarCadastro')->name('autorizacao.locacao.finalizar_cadastro');

    Route::post('/autorizacao/locacao/update', 'AutorizacaoLocacaoController@update')->name('autorizacao.locacao.update');


    Route::post('/autorizacao/locacao/salvar', 'AutorizacaoLocacaoController@salvarAutorizacao')->name('autorizacao.locacao.salvar');

    Route::post('/autorizacao/locacao/documento/store', 'AutorizacaoLocacaoController@documentoStore')->name('autorizacao.locacao.documento.store');

    /**Fim Rotas gerenciamento de autorizacao locação**/


});


Route::get('/home', 'AdminController@index');

Route::get('/', function () {
    return view('site.index');
});
Route::get('/', 'Site\SiteController@index')->name('site.index');


Route::get('/imoveis', 'Site\SiteController@imoveis')->name('site.imoveis');

Route::get('/imovel/detail/{imovel}', 'Site\SiteController@detail')->name('site.imovel.detail');

Route::post('/imovel/buscar', 'Site\SiteController@buscar')->name('imoveis.busca');


Route::get('/sobre', function () {
    return view('site.about');
})->name('site.sobre');



Route::get('/contact', function () {
    return view('site.contact');
})->name('site.contact');




Route::get('/element', function () {
    return view('site.element');
});

Route::post('/email', 'Admin\EmailController@store')->name('admin.email.store');

Route::post('/email2', 'Admin\EmailController@store2')->name('admin.email.store2');

Route::get('/perfil', 'UsuarioController@perfil')->name('perfil');

Route::post('/perfil/foto/store', 'UsuarioController@fotoStore')->name('perfil.foto.store');

Route::get('/corretores', 'Site\SiteController@corretores')->name('site.corretores');

Route::put('/perfil', 'UsuarioController@updatePerfil')->name('perfil.update');

Route::get('/correspondente', function () {
    return view('site.correspondente');
})->name('site.correspondentes');
Auth::routes();


//rotas administrativas
Route::group(['middleware' => ['auth', 'checkadmin']], function () {
    Route::group(['prefix' => 'admin'], function () {

            //Rota Pagina inicial Tela administrador
            Route::get('index', 'AdminController@index')->name('admin.index');
            //rotas administrativas administrar Usuários
        Route::resource('tipo_imovel', 'Admin\TipoImovelController');


        /*Rotas gerenciamento de email*/
        Route::get('/email', 'Admin\EmailController@index')->name('admin.email.index');



        Route::get('/email/nao_lido', 'Admin\EmailController@naoLidos')->name('admin.email.nao_lido');

        Route::get('/email/excluidos', 'Admin\EmailController@excluidos')->name('admin.email.excluidos');


        Route::get('/email/{id}/show', 'Admin\EmailController@show')->name('admin.email.show');

        Route::get('/email/{id}/destroy', 'Admin\EmailController@destroy')->name('admin.email.destroy');

        Route::get('/email/{id}/recuperar', 'Admin\EmailController@recuperar')->name('admin.email.recuperar');

        /*Fim rotas de gerenciamento de email*/
        Route::get('admin/corretor', 'Admin\CorretorController@index')->name('admin.corretor.index');

        Route::get('admin/corretor/{corretor}/destroy', 'Admin\CorretorController@destroy')->name('admin.corretor.destroy');

        Route::get('admin/corretor/{corretor}/edit', 'Admin\CorretorController@edit')->name('admin.corretor.edit');


        Route::put('admin/corretor/update', 'Admin\CorretorController@update')->name('admin.corretor.update');

        Route::resource('corretor', 'Admin\CorretorController');

        Route::get('tipo_imovel/{tipo_imovel}/delete', 'Admin\TipoImovelController@delete')->name('tipo_imovel_delete');

        Route::group(['prefix' => 'usuario'], function () {
            Route::get('index', 'UsuarioController@index')->name('admin.usuario.index');
            Route::get('/{usuario}/edit', 'UsuarioController@edit')->name('admin.usuario.edit');
            Route::get('/{usuario}/destroy', 'UsuarioController@destroy')->name('admin.usuario.destroy');
            Route::post('store', 'UsuarioController@store')->name('admin.usuario.save');
            Route::put('/{usuario}/update', 'UsuarioController@update')->name('admin.usuario.update');
        });


        Route::group(['prefix' => 'proprietario'], function () {
            Route::get('/juridico/index', 'Admin\ProprietarioController@indexJuridico')->name('admin.proprietario.juridico.index');
            Route::get('/juridico/create', 'Admin\ProprietarioController@createJuridico')->name('admin.proprietario.juridico.create');
            Route::get('/juridico/{proprietario}/edit', 'Admin\ProprietarioController@editJuridico')->name('admin.proprietario.juridico.edit');
            Route::get('/juridico/{proprietario}/destroy', 'Admin\ProprietarioController@destroyJuridico')->name('admin.proprietario.juridico.destroy');
            Route::get('/juridico/{proprietario}/detail', 'Admin\ProprietarioController@detalheJuridico')->name('admin.proprietario.juridico.detalhe');
            Route::get('/juridico/{documento}/download', 'Admin\ProprietarioController@documentoDownloadJuridico')->name('admin.proprietario.juridico.documento.download');
            Route::get('/juridico/{documento}/delete', 'Admin\ProprietarioController@documentoDeleteJuridico')->name('admin.proprietario.juridico.documento.delete');
            Route::post('/juridico/store', 'Admin\ProprietarioController@storeJuridico')->name('admin.proprietario.juridico.store');
            Route::post('/juridico/documento/store', 'Admin\ProprietarioController@documentoStoreJuridico')->name('admin.proprietario.juridico.documento.store');
            Route::put('/juridico/{proprietario}/update', 'Admin\ProprietarioController@updateJuridico')->name('admin.proprietario.juridico.update');


            //rotas pesssoa fisica

            Route::get('/fisica/index', 'Admin\ProprietarioController@indexFisica')->name('admin.proprietario.fisico.index');
            Route::get('/fisica/create', 'Admin\ProprietarioController@createFisica')->name('admin.proprietario.fisico.create');
            Route::get('/fisica/{proprietario}/edit', 'Admin\ProprietarioController@editFisica')->name('admin.proprietario.fisico.edit');
            Route::get('/fisica/{proprietario}/destroy', 'Admin\ProprietarioController@destroyFisica')->name('admin.proprietario.fisico.destroy');
            Route::get('/fisica/{proprietario}/detail', 'Admin\ProprietarioController@detalheFisica')->name('admin.proprietario.fisico.detalhe');
            Route::get('/fisica/{documento}/download', 'Admin\ProprietarioController@documentoDownloadFisica')->name('admin.proprietario.fisico.documento.download');
            Route::get('/fisica/{documento}/delete', 'Admin\ProprietarioController@documentoDeleteFisica')->name('admin.proprietario.fisico.documento.delete');
            Route::post('/fisica/store', 'Admin\ProprietarioController@storeFisica')->name('admin.proprietario.fisico.store');
            Route::post('/fisica/documento/store', 'Admin\ProprietarioController@documentoStoreFisica')->name('admin.proprietario.fisico.documento.store');
            Route::put('/fisica/{proprietario}/update', 'Admin\ProprietarioController@updateFisica')->name('admin.proprietario.fisico.update');
        });
        Route::group(['prefix' => 'imoveis'], function () {
            Route::get('aluguel/index', 'Admin\ImovelController@indexAluguel')->name('admin.imoveis.aluguel.index');
            Route::get('aluguel/create', 'Admin\ImovelController@createAluguel')->name('admin.imoveis.aluguel.create');
            Route::get('aluguel/{imoveis}/edit', 'Admin\ImovelController@editAluguel')->name('admin.imoveis.aluguel.edit');
            Route::get('aluguel/{imoveis}/detail', 'Admin\ImovelController@detailAluguel')->name('admin.imoveis.aluguel.detail');
            Route::get('destaque/index', 'Site\DestaqueController@index')->name('admin.imoveis.destaque');
            Route::get('destaque/create', 'Site\DestaqueController@create')->name('admin.imoveis.destaque.create');
            Route::get('destaque/{imovel}/destroy', 'Site\DestaqueController@destroy')->name('admin.imoveis.destaque.destroy');
            Route::get('aluguel/{imoveis}/destroy', 'Admin\ImovelController@destroyAluguel')->name('admin.imoveis.aluguel.destroy');
            Route::get('aluguel/{imoveis}/desativar', 'Admin\ImovelController@desativarAluguel')->name('admin.imoveis.aluguel.desativar');
            Route::get('aluguel/{imoveis}/ativar', 'Admin\ImovelController@ativarAluguel')->name('admin.imoveis.aluguel.ativar');
            Route::post('aluguel/store', 'Admin\ImovelController@storeAluguel')->name('admin.imoveis.aluguel.store');
            Route::post('destaque/store', 'Site\DestaqueController@store')->name('admin.imoveis.destaque.store');
            Route::get('aluguel/imagem/create/{imovel}', 'Admin\ImovelController@imagemCreateAluguel')->name('admin.imoveis.aluguel.imagem.create');
            Route::get('aluguel/imagem/principal/ativar/{imagem}', 'Admin\ImovelController@imagemPrincipalAtivarAluguel')->name('admin.imoveis.aluguel.imagem.principal.ativar');
            Route::get('aluguel/imagem/principal/delete/{imagem}', 'Admin\ImovelController@imagemDeleteAluguel')->name('admin.imoveis.aluguel.imagem.principal.delete');
            Route::get('aluguel/imagem/principal/desativar/{imagem}', 'Admin\ImovelController@imagemPrincipalDesativarAluguel')->name('admin.imoveis.aluguel.imagem.principal.desativar');
            Route::post('aluguel/imagem/store', 'Admin\ImovelController@imagemStoreAluguel')->name('admin.imoveis.aluguel.imagem.store');
            Route::put('aluguel/{imoveis}/update', 'Admin\ImovelController@updateAluguel')->name('admin.imoveis.aluguel.update');


            Route::get('venda/index', 'Admin\ImovelController@indexVenda')->name('admin.imoveis.venda.index');
            Route::get('venda/create', 'Admin\ImovelController@createVenda')->name('admin.imoveis.venda.create');
            Route::get('venda/{imoveis}/edit', 'Admin\ImovelController@editVenda')->name('admin.imoveis.venda.edit');
            Route::get('venda/{imoveis}/detail', 'Admin\ImovelController@detailVenda')->name('admin.imoveis.venda.detail');
            Route::get('venda/{imoveis}/destroy', 'Admin\ImovelController@destroyVenda')->name('admin.imoveis.venda.destroy');
            Route::get('venda/{imoveis}/desativar', 'Admin\ImovelController@desativarVenda')->name('admin.imoveis.venda.desativar');
            Route::get('venda/{imoveis}/ativar', 'Admin\ImovelController@ativarVenda')->name('admin.imoveis.venda.ativar');
            Route::post('venda/store', 'Admin\ImovelController@storeVenda')->name('admin.imoveis.venda.store');
            Route::get('venda/imagem/create/{imovel}', 'Admin\ImovelController@imagemCreateVenda')->name('admin.imoveis.venda.imagem.create');
            Route::get('venda/imagem/principal/ativar/{imagem}', 'Admin\ImovelController@imagemPrincipalAtivarVenda')->name('admin.imoveis.venda.imagem.principal.ativar');
            Route::get('venda/imagem/principal/delete/{imagem}', 'Admin\ImovelController@imagemDeleteVenda')->name('admin.imoveis.venda.imagem.principal.delete');
            Route::get('venda/imagem/principal/desativar/{imagem}', 'Admin\ImovelController@imagemPrincipalDesativarVenda')->name('admin.imoveis.venda.imagem.principal.desativar');
            Route::post('venda/imagem/store', 'Admin\ImovelController@imagemStoreVenda')->name('admin.imoveis.venda.imagem.store');
            Route::put('venda/{imoveis}/update', 'Admin\ImovelController@updateVenda')->name('admin.imoveis.venda.update');
        });
        Route::get('site/banner', 'BannerController@index')->name('site.banner');
        Route::get('site/{banner}/banner', 'BannerController@destroy')->name('site.destroy');
        Route::post('site/banner/save', 'BannerController@save')->name('site.banner.save');
        Route::resource('visita', 'VisitaController');
        Route::get('/visita/{visita}/delete', 'VisitaController@destroy')->name('admin.visita.destroy');
        });

});


//rotas site

Route::group(['middleware' => ['auth', 'checkcorretor']], function () {
    Route::group(['prefix' => 'corretor'], function () {
        //Rota Pagina inicial Tela administrador
        Route::get('index', 'CorretorController@index')->name('corretor.index');

        Route::group(['prefix' => 'proprietario'], function () {
            Route::get('/juridico/index', 'Corretor\ProprietarioController@indexJuridico')->name('corretor.proprietario.juridico.index');
            Route::get('/juridico/create', 'Corretor\ProprietarioController@createJuridico')->name('corretor.proprietario.juridico.create');
            Route::get('/juridico/{proprietario}/edit', 'Corretor\ProprietarioController@editJuridico')->name('corretor.proprietario.juridico.edit');
            Route::get('/juridico/{proprietario}/destroy', 'Corretor\ProprietarioController@destroyJuridico')->name('corretor.proprietario.juridico.destroy');
            Route::get('/juridico/{proprietario}/detail', 'Corretor\ProprietarioController@detalheJuridico')->name('corretor.proprietario.juridico.detalhe');
            Route::get('/juridico/{documento}/download', 'Corretor\ProprietarioController@documentoDownloadJuridico')->name('corretor.proprietario.juridico.documento.download');
            Route::get('/juridico/{documento}/delete', 'Corretor\ProprietarioController@documentoDeleteJuridico')->name('corretor.proprietario.juridico.documento.delete');
            Route::post('/juridico/store', 'Corretor\ProprietarioController@storeJuridico')->name('corretor.proprietario.juridico.store');
            Route::post('/juridico/documento/store', 'Corretor\ProprietarioController@documentoStoreJuridico')->name('corretor.proprietario.juridico.documento.store');
            Route::put('/juridico/{proprietario}/update', 'Corretor\ProprietarioController@updateJuridico')->name('corretor.proprietario.juridico.update');


            Route::get('/fisica/index', 'Corretor\ProprietarioController@indexFisica')->name('corretor.proprietario.fisico.index');
            Route::get('/fisica/create', 'Corretor\ProprietarioController@createFisica')->name('corretor.proprietario.fisico.create');
            Route::get('/fisica/{proprietario}/edit', 'Corretor\ProprietarioController@editFisica')->name('corretor.proprietario.fisico.edit');
            Route::get('/fisica/{proprietario}/destroy', 'Corretor\ProprietarioController@destroyFisica')->name('corretor.proprietario.fisico.destroy');
            Route::get('/fisica/{proprietario}/detail', 'Corretor\ProprietarioController@detalheFisica')->name('corretor.proprietario.fisico.detalhe');
            Route::get('/fisica/{documento}/download', 'Corretor\ProprietarioController@documentoDownloadFisica')->name('corretor.proprietario.fisico.documento.download');
            Route::get('/fisica/{documento}/delete', 'Corretor\ProprietarioController@documentoDeleteFisica')->name('corretor.proprietario.fisico.documento.delete');
            Route::post('/fisica/store', 'Corretor\ProprietarioController@storeFisica')->name('corretor.proprietario.fisico.store');
            Route::post('/fisica/documento/store', 'Corretor\ProprietarioController@documentoStoreFisica')->name('corretor.proprietario.fisico.documento.store');
            Route::put('/fisica/{proprietario}/update', 'Corretor\ProprietarioController@updateFisica')->name('corretor.proprietario.fisico.update');

        });
        Route::group(['prefix' => 'imoveis'], function () {
            Route::get('venda/index', 'Corretor\ImovelController@indexVenda')->name('corretor.imoveis.venda.index');
            Route::get('venda/{imoveis}/detail', 'Corretor\ImovelController@detailVenda')->name('corretor.imoveis.venda.detail');

            Route::get('aluguel/index', 'Corretor\ImovelController@indexAluguel')->name('corretor.imoveis.aluguel.index');
            Route::get('aluguel/{imoveis}/detail', 'Corretor\ImovelController@detailAluguel')->name('corretor.imoveis.aluguel.detail');
        });
        Route::resource('corretorvisita', 'Corretor\VisitaController');

        Route::get('/visita/{visita}/delete', 'Corretor\VisitaController@destroy')->name('corretor.visita.destroy');
    });

});

Route::group(['middleware' => ['auth', 'checkadministrativo']], function () {
    Route::group(['prefix' => 'administrativo'], function () {
        //Rota Pagina inicial Tela administrador
        Route::get('index', 'Administrativo\AdministrativoController@index')->name('administrativo.index');

        Route::group(['prefix' => 'proprietario'], function () {
            Route::get('/juridico/index', 'Administrativo\ProprietarioController@indexJuridico')->name('administrativo.proprietario.juridico.index');
            Route::get('/juridico/create', 'Administrativo\ProprietarioController@createJuridico')->name('administrativo.proprietario.juridico.create');
            Route::get('/juridico/{proprietario}/edit', 'Administrativo\ProprietarioController@editJuridico')->name('administrativo.proprietario.juridico.edit');
            Route::get('/juridico/{proprietario}/destroy', 'Administrativo\ProprietarioController@destroyJuridico')->name('administrativo.proprietario.juridico.destroy');
            Route::get('/juridico/{proprietario}/detail', 'Administrativo\ProprietarioController@detalheJuridico')->name('administrativo.proprietario.juridico.detalhe');
            Route::get('/juridico/{documento}/download', 'Administrativo\ProprietarioController@documentoDownloadJuridico')->name('administrativo.proprietario.juridico.documento.download');
            Route::get('/juridico/{documento}/delete', 'Administrativo\ProprietarioController@documentoDeleteJuridico')->name('administrativo.proprietario.juridico.documento.delete');
            Route::post('/juridico/store', 'Administrativo\ProprietarioController@storeJuridico')->name('administrativo.proprietario.juridico.store');
            Route::post('/juridico/documento/store', 'Administrativo\ProprietarioController@documentoStoreJuridico')->name('administrativo.proprietario.juridico.documento.store');
            Route::put('/juridico/{proprietario}/update', 'Administrativo\ProprietarioController@updateJuridico')->name('administrativo.proprietario.juridico.update');


            //rotas pesssoa fisica

            Route::get('/fisica/index', 'Administrativo\ProprietarioController@indexFisica')->name('administrativo.proprietario.fisico.index');
            Route::get('/fisica/create', 'Administrativo\ProprietarioController@createFisica')->name('administrativo.proprietario.fisico.create');
            Route::get('/fisica/{proprietario}/edit', 'Administrativo\ProprietarioController@editFisica')->name('administrativo.proprietario.fisico.edit');
            Route::get('/fisica/{proprietario}/destroy', 'Administrativo\ProprietarioController@destroyFisica')->name('administrativo.proprietario.fisico.destroy');
            Route::get('/fisica/{proprietario}/detail', 'Administrativo\ProprietarioController@detalheFisica')->name('administrativo.proprietario.fisico.detalhe');
            Route::get('/fisica/{documento}/download', 'Administrativo\ProprietarioController@documentoDownloadFisica')->name('administrativo.proprietario.fisico.documento.download');
            Route::get('/fisica/{documento}/delete', 'Administrativo\ProprietarioController@documentoDeleteFisica')->name('administrativo.proprietario.fisico.documento.delete');
            Route::post('/fisica/store', 'Administrativo\ProprietarioController@storeFisica')->name('administrativo.proprietario.fisico.store');
            Route::post('/fisica/documento/store', 'Administrativo\ProprietarioController@documentoStoreFisica')->name('administrativo.proprietario.fisico.documento.store');
            Route::put('/fisica/{proprietario}/update', 'Administrativo\ProprietarioController@updateFisica')->name('administrativo.proprietario.fisico.update');

        });
        Route::group(['prefix' => 'imoveis'], function () {
            Route::get('venda/index', 'Administrativo\ImovelController@indexVenda')->name('administrativo.imoveis.venda.index');
            Route::get('venda/{imoveis}/detail', 'Administrativo\ImovelController@detailVenda')->name('administrativo.imoveis.venda.detail');

            Route::get('aluguel/index', 'Administrativo\ImovelController@indexAluguel')->name('administrativo.imoveis.aluguel.index');
            Route::get('aluguel/{imoveis}/detail', 'Administrativo\ImovelController@detailAluguel')->name('administrativo.imoveis.aluguel.detail');
        });
        Route::resource('administrativovisita', 'Administrativo\VisitaController');
        Route::get('/{visita}/delete', 'Administrativo\VisitaController@destroy')->name('administrativo.visita.destroy');
    });

});
Auth::routes();



Route::get('/home', 'HomeController@index')->name('home');
