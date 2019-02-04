<?php

if (isset($_POST)){
        //Cargar conexion+
    require_once 'includes/conexion.php';
    //INICIAR SESSION
    if(!isset($_SESSION)){
       session_start(); 
    }
    //recoger los valores del formulario de registro operador terniario ?   : si existe la variable lo toma de lo contrario es falso es como un if
    //mysqli_real_escape_string para dar seguridad a los string
    $nombre = isset($_POST['nombre'])? mysqli_real_escape_string($db,$_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db,$_POST['apellidos']) :false;
    $email= isset($_POST['email']) ?  mysqli_real_escape_string($db,trim($_POST['email'])) :false;
    $password = isset ($_POST['password']) ?  mysqli_real_escape_string($db,$_POST['password']) : false;
    
    //Array de errores//
$errores = array();

// validar los datos antes de guardarlos en la base de datos 
// validacion para nombre
if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
    //echo 'el nombre es valido';
    $nombre_validado = true;
 } else{
     $nombre_validado = false;
     $errores['nombre']= "El nombre no es valido";  
 } 
//validacion para apellidos
if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/",$apellidos)){
    $apellidos_validado = true;
 } else {
     $apellidos_validado = false;
     $errores['apellidos']= "Los apellidos no son validos";     
    }
   
// validacion para email
    
    if(!empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL)){
    $email_validado = true;
 } else {
     $email_validado = false;
     $errores['email']= "el email no son validos";     
    }
    
    // validacion para password
    
    if(!empty($password)){
    $password_validado = true;
 } else {
    $password_validado = false;
     $errores['password']= "Contraseña vacia";     
    }
  $guardar_usuario=false; 
 if (count ($errores)==0){
     $guardar_usuario=true;
     
// CIFRAR LA CONTRASEÑA
     $password_segura = password_hash($password, PASSWORD_BCRYPT,['cost'=>4]);
    

// INSERTAMOS USUARIOS EN LA BASE DE DATOS
 $sql="INSERT INTO usuarios Values(null,'$nombre','$apellidos','$email','$password_segura',CURDATE());";
 $guardar= mysqli_query($db, $sql);
 //var_dump(mysqli_error($db));
 //die;
 
 if ($guardar){
     $_SESSION['completado']= "el registro se ha completado con exito";   
 }else {
     $_SESSION['errores']['general']= "Fallos al guardar el usuario!";
 } 
 
 }else{
     $_SESSION['errores']=$errores;
    
 }
    
    }
  header('location: index.php');