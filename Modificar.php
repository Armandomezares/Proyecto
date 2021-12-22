<?php 
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db,$port);

    if ($conexion->connect_error) die ("Fatal error");

    $titulo = mysql_entities_fix_string($conexion, $_POST['Titulo']);
    $modificar = mysql_entities_fix_string($conexion,$_POST['Fecha_Vencimiento']);
    $query = "UPDATE tareas SET Fecha_Vencimiento='$modificar' WHERE Titulo= '$titulo'";

    $result = $conexion->query($query);

    if (!$result) die ("Modificar fallo");
    header('Location:sqltest.php');

    $conexion->close();
    function mysql_entities_fix_string($conexion, $string)
    {
        return htmlentities(mysql_fix_string($conexion, $string));
      }
    function mysql_fix_string($conexion, $string)
    {
        #if (get_magic_quotes_gpc()) $string = stripslashes($string);
        return $conexion->real_escape_string($string);
      }   
   
?>