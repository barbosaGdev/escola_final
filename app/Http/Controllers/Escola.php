<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Escola extends Controller
{

    public function registerEscola(){
        \App\Escola::registerEscola();
        return "SUCESSO";
    }

    public function getEscola(){
        $escolas = \App\Escola::getEscola();
        return redirect("/schools", compact('escolas', $escolas));
    }

    public function verEscola(){

        $visao = new \App\Escola();
        
        $escolas = $visao->getEscolaById($_GET['id']);
        return view('edit_school', 
        [
            'escolas' => $escolas[0],
        ]
    );
    }
    
    
    public function deletarEscola(){
        \App\Escola::deletarEscola();
        return redirect("/schools");
    }

}
