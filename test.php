
<form method="POST" action="" enctype="multipart/form-data">
    <input type="hidden" name="MAX-FILE-SIZE" value="500000">
    <input type="file" name="meme">
    <input type="submit" name="envoyer" value="envoyer">
</form>

<?php

error_reporting(E_ALL ^ E_NOTICE | E_WARNING);
ini_set('display_errors', 'ON');





if(isset($_FILES['meme'])){

    $dossier = './assets/upload/';  
    $errors =  "";
    $file_name = $_FILES['meme']['name'];
    $file_ext=end(explode('.',$_FILES['meme']['name']));
    $ext=array('jpg','png','jpeg');

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

        if(in_array($file_ext,$ext, true)){
            if( move_uploaded_file($_FILES['meme']['tmp_name'], $dossier.$file_name) ){
                    echo 'GG';
                }
        }
        else{
            $errors = 'Extension not allowed';
            echo $errors;
        }
          
    }

}
?>