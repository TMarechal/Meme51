<?php

class GenerateurController extends Controller {

    public function VerifUpload(){
        $message = '';

        if(isset($_POST['envoyer'])){
            $dossier = './assets/upload/';  
            $errors =  "";
            $file_name = $_FILES['meme']['name'];
            $file_ext = end(explode('.',$_FILES['meme']['name']));
            $ext = array('jpg','png','jpeg');
        
            switch ($_FILES['meme']['error']) { 
                case UPLOAD_ERR_INI_SIZE: 
                    $message = "The uploaded file exceeds the upload_max_filesize directive in php.ini"; 
                    break; 
                case UPLOAD_ERR_FORM_SIZE: 
                    $message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
                    break; 
                case UPLOAD_ERR_PARTIAL: 
                    $message = "The uploaded file was only partially uploaded"; 
                    break; 
            }
        
            if($_FILES['meme']['error'] == UPLOAD_ERR_OK){
                if(in_array($file_ext, $ext, true)){
                    $file_name = 'meme_'.time().'.'.$file_ext;

                    if( move_uploaded_file($_FILES['meme']['tmp_name'], $dossier.$file_name) ){
                        chmod($dossier.$file_name, 0777);
                            $message = 'GG';
                            Meme::Send($file_name);
                        }
                } else {
                    $message = 'Extension not allowed';
                }
            }
        }
    
        $template = $this->twig->loadTemplate('/Page/gmeme.html.twig');
        echo $template->render(array(
            'message'   => $message
        ));
    }
    
}