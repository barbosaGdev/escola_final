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

session_start();

Route::get('/', function () {
    $cidades = \App\Cidade::getCidades();  
    $escolas = \App\Escola::getEscolas();  
    return view('home', ["cidades" => $cidades, "escolas" => $escolas]);
});


// COMUNIDADE

Route::get("get/view/login", "Controller@returnViewRegistration");

Route::get("popup", "Controller@returnViewPopUp");

Route::post("registrar/candidato", "Candidato@register");

Route::get("success", "Controller@success");

Route::get("login", "Controller@returnViewlogin");

Route::get("logout", "Controller@returnViewLogout");

Route::post("doLogin", 'User@login');

Route::get("follow", "User@follow");

// ADM

Route::get("adm", ['middleware' => 'authAdmin', 'uses' => 'Adm@returnViewAdm']);

Route::get("citys", ['middleware' => 'authAdmin', 'uses' => 'Adm@returnViewCitys']);

Route::post("add/city", ['middleware' => 'authAdmin', 'uses' => 'Adm@Cidade@registerCidade']);

Route::post("delete/city", ['middleware' => 'authAdmin', 'uses' => 'Cidade@deletarCidade']);

Route::get("schools", ['middleware' => 'authAdmin', 'uses' => 'Controller@returnViewSchools']);

Route::get("create/school", ['middleware' => 'authAdmin', 'uses' => 'Controller@returnViewCreateSchool']);

Route::post("add/school", ['middleware' => 'authAdmin', 'uses' => 'Escola@registerEscola']);

Route::post("delete/school", ['middleware' => 'authAdmin', 'uses' => 'Escola@deletarEscola']);

Route::get("cad/user", ['middleware' => 'authAdmin', 'uses' => 'Controller@returnViewRegisterUser']);

Route::post("add/user", ['middleware' => 'authAdmin', 'uses' => 'User@registerUsuario']);

// SECRETÁRIO

Route::get("secretario", ['middleware' => 'authAdmin', 'uses' => 'User@secretario']);

Route::post("verificar", "User@verificar");

// SUPERVISOR

Route::get("supervisor", ['middleware' => 'authAdmin', 'uses' => 'User@supervisor']);

Route::get("show/schools", ['middleware' => 'authAdmin', 'uses' => 'User@supervisor']);

Route::get("ver/candidatos", ['middleware' => 'authAdmin', 'uses' => 'User@candidatos']);

Route::get("ver/candidato", ['middleware' => 'authAdmin', 'uses' => 'User@candidato']);

Route::post("edit/candidato", ['middleware' => 'authAdmin', 'uses' => 'User@editCandidato']);

Route::get("ver/escola", ['middleware' => 'authAdmin', 'uses' => 'Escola@verEscola']);

Route::post("edit/escola", ['middleware' => 'authAdmin', 'uses' => 'Escola@returnViewEditarEscola']);

Route::get("/delete/candidato", ['middleware' => 'authAdmin', 'uses' => 'User@deleteCandidato']);

Route::get("vincular", ['middleware' => 'authAdmin', 'uses' => 'User@vincular']);

Route::get("vincular/escola", ['middleware' => 'authAdmin', 'uses' => 'User@vincularEscola']);

Route::get("confir/vinculacao", ['middleware' => 'authAdmin', 'uses' => 'User@confirmarVinculacao']);

Route::get("confir/vinculacao/supervisionar", ['middleware' => 'authAdmin', 'uses' => 'User@confirmarVinculacaoSupervisionar']);

Route::get("start", ['middleware' => 'authAdmin', 'uses' => 'User@start']);

Route::post("get/schools/filtred", ['middleware' => 'authAdmin', 'uses' => 'User@getSchools']);

Route::get("verifydate", ['middleware' => 'authAdmin', 'uses' => 'Controller@verifyDate']);

Route::get("generate/xls", ['middleware' => 'authAdmin', 'uses' => 'Controller@generateXls']);

Route::get("ver/comprovante", ['middleware' => 'authAdmin', 'uses' => 'Controller@verComprovante']);

Route::get("ver/laudo", ['middleware' => 'authAdmin', 'uses' => 'Controller@verLaudo']);
