<?php

$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
//$clave = hash('sha512', $contraseña);
session_start();
$_SESSION['correo'] = $correo;

include('dbConnect.php');
$consulta = "SELECT * FROM usuario where correo = '$correo' and contraseña = '$contraseña'";
$resultado = mysqli_query($conexion, $consulta);
$filas = mysqli_fetch_array($resultado);
//$filas[3];

if ($filas == true) {
    $rol = $filas[9];
    $_SESSION['roles_idroles'] = $rol;
    if ($rol == 2) {
        header("location: ../panel.php");
    }elseif($rol == 3){
        header("location: ../Crear Curso.php");
    }elseif($rol == 1){
        header("location: ../login.php?fallo=true");
        session_destroy();
        die();
    }
}else{
    header("location: ../login.php?fallo=true");
    die();
}

mysqli_free_result($resultado);
mysqli_close($conexion);

?>