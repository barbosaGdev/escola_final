<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Adm extends Controller
{
    public function returnViewAdm(){
        return view("adm");
    }

    public function returnViewCitys(){
        $cidades = \App\Cidade::getCidades();

        return view("citys", ["cidades" => $cidades]);
    }

}
