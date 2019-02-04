<?php
//iniciar la seccion y conexion a la base de datos
require_once 'includes/conexion.php';


//recoger los dstos del formulario
if(isset($_POST)){
    $email= trim($_POST['email']);
    $password = $_POST['password'];
    
// consultar para comprpbar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($bd, $sql);
    
    if ($login && mysqli_num_rows($login) == 1){
        $usuario = mysqli_fetch_assoc($login);
     
    // comprobar la contraseña// cifrar
   $verify = $password_verify($password, $usuario['password']);
  
   if ($verify) {
     //utilizar una sesion´para guardar los datos del usuario logeados
       $_SESSION['usuario']=$usuario;
       
       
       if (isset($_SESSION['error_login'])){
           session_unset($_SESSION['error_login']);
       }
   
       
   }else{
       // envia una sesion con el fallo
       $_SESSION['error_login']= "login incorrecto!!";
   }
    }else{
        // msg de error
         $_SESSION['error_login']= "login incorrecto!!";  
    }
}

// Redirigir

header('location: index.php');
