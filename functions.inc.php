<?php

/* YETI APP HELPER FUNCTIONS */

function message_erreur($errors, $input){
    if(count($_POST)>0){
        $message = '';
        if($errors[$input] !=''){
                $message = $message . '<li>' . $errors[$input] .'</li>';
            
        }
    return '<ul class="error_messages">'.$message.'</ul>';
    }
}
