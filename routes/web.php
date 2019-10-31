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

Route::get("get/view/login", "Controller@returnViewRegistration");

Route::post("registrar/candidato", "Candidato@register");

Route::get("success", "Controller@success");

Route::get("login", "Controller@returnViewlogin");

Route::get("adm", "Adm@returnViewAdm");

Route::get("citys", "Adm@returnViewCitys");

Route::post("add/city", "Cidade@registerCidade");

Route::post("delete/city", "Cidade@deletarCidade");

Route::get("schools", "Controller@returnViewSchools");

Route::get("create/school", "Controller@returnViewCreateSchool");

Route::post("add/school", "Escola@registerEscola");

Route::post("delete/school", "Escola@deletarEscola");

Route::get("cad/user", "Controller@returnViewRegisterUser");

Route::post("add/user", "User@registerUsuario");

Route::post("login", "User@login");

Route::get("secretario", "User@secretario");

Route::get("follow", "User@follow");

Route::post("verificar", "User@verificar");

Route::get("supervisor", "User@supervisor");

Route::get("show/schools", "User@mostrarEscolas");

Route::get("ver/candidatos", "User@candidatos");

Route::get("ver/candidato", "User@candidato");

Route::post("edit/candidato", "User@editCandidato");

Route::get("/delete/candidato", "User@deleteCandidato");

Route::get("vincular", "User@vincular");

Route::get("vincular/escola", "User@vincularEscola");

Route::get("confir/vinculacao", "User@confirmarVinculacao");

Route::get("confir/vinculacao/supervisionar", "User@confirmarVinculacaoSupervisionar");

Route::get("start", "User@start");

Route::post("get/schools/filtred", "User@getSchools");

Route::get("verifydate", "Controller@verifyDate");

Route::get("generate/xls", "Controller@generateXls");

Route::get("ver/comprovante", "Controller@verComprovante");

Route::get("ver/laudo", "Controller@verLaudo");
