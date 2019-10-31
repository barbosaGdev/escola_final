<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Cidade extends Controller
{
    public function registerCidade(){
        \App\Cidade::CadastrarCidade();
        return redirect("/citys");
    }

    public function deletarCidade(){
        \App\Cidade::deletarCidade();
        return redirect("/citys");
    }

}
