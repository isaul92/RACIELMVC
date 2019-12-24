<?php
require_once 'models/obrasArquitectoModel.php';

class obrasArquitectoController {
    
    
    
         public function ver() {
     
        $editar = true;
        if (isset($_GET["id"])) {
            $obra = new obrasArquitectoModel();
            $obra->setId($_GET["id"]);
            $ob = $obra->getOne();
        }
        require_once './views/ObrasViews/verObraView.php';
    }
    
    
}