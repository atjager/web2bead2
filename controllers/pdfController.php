<?php
class PdfController {
    public function home(){
        require_once('views/pdf/index.php');
       
       
    }

    public function export(){
        header('Location: createPdf.php?hit='.$_POST['hit']);
        
    }
    
}

?>
