<?php

//funciones para mostrar error

function mostrarError($errores,$campo){
    $alerta='';
    if (isset($errores[$campo]) && !empty($campo)){
        $alerta="<div class = 'alerta alerta-error'>".$errores[$campo].'</div>';  
    }
    return $alerta;
}

function borrarErrores(){
    $borrado=false;
    
    if (isset($_SESSION['errores'])){
        $_SESSION['errores']=null;
        $borrado = session_unset($_SESSION['errrores']);   
    }
      
      
   if(isset($_SESSION['completado'])){
         $_SESSION['completado']=null;
       session_unset($_SESSION['completado']);
   }
      
      
    return $borrado;
}