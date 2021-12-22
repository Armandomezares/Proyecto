<?php //signup.php
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db, $port);
    if ($conexion->connect_error) die ("Fatal error");

    if(isset($_POST['username']) && isset($_POST['password']))
    {   
        
        $usuarios_id = mysql_entities_fix_string($conexion, $_POST['usuarios_idusuario']);
        $Titulo1 = mysql_entities_fix_string($conexion, $_POST['Titulo']);
        $Contenido1 = mysql_entities_fix_string($conexion, $_POST['Contenido']);
        $Fecha_Registro1= mysql_entities_fix_string($conexion, $_POST['Fecha_Registro']);
        $Fecha_Vencimiento1 = mysql_entities_fix_string($conexion, $_POST['Fecha_Vencimiento']);
        $Prioridad1 = mysql_entities_fix_string($conexion, $_POST['Prioridad']);

        $password = password_hash($pw_temp, PASSWORD_DEFAULT);

        $query = "INSERT INTO archivados 
            VALUES( $usuarios_id,'$Titulo1','$Contenido1','$Fecha_Registro1','$Fecha_Vencimiento1', '$Prioridad1')";

        $result = $conexion->query($query);
        if (!$result) die ("Falló registro");

        header('Location: sqltest.php');
        
    }
    else
   
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