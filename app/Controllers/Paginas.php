<?php

class Paginas extends Controller{

    public function index(){

        $dados = [
            'titulo' => 'Titulo da pagina',
            'texto' => 'Texto da pagina'
        
        ];

        $this->view('paginas/home',$dados);
    }


   public function sobre(){
        $dados = [
            'tituloSobre' => 'Titulo sobre nós',
            'textoSobre' => 'Texto da pagina'
        
        ];

        $this->view('paginas/sobre', $dados);
    }

}