<?php 
    require_once 'login.php';
    $conexion = new mysqli($hn, $un, $pw, $db,$port);

    if ($conexion->connect_error) die ("Fatal error");
    session_start();
    $usuario1 =$_SESSION['id_usuario'];
    if (
        isset($_POST['Titulo']) &&
        isset($_POST['Contenido']) &&
        isset($_POST['Fecha_Registro']) &&
        isset($_POST['Fecha_Vencimiento']) &&
        isset($_POST['Prioridad']) )
    {
        
        $Titulo = get_post($conexion, 'Titulo');
        $Contenido = get_post($conexion, 'Contenido');
        $Fecha_Registro = get_post($conexion, 'Fecha_Registro');
        $Fecha_Vencimiento = get_post($conexion, 'Fecha_Vencimiento');
        $Prioridad = get_post($conexion, 'Prioridad');
        $query = "INSERT INTO tareas VALUE " .
            "('$usuario1','$Titulo', '$Contenido', '$Fecha_Registro', '$Fecha_Vencimiento', '$Prioridad')";
        $result = $conexion->query($query);
        
        if (!$result) echo "INSERT falló <br><br>";
        header('Location: sqltest.php');

    }
    else{
        echo <<<_END
    <form action="sqltest.php" method="post"><pre>
    <input type="hidden" name="usuarios_idusuario" value="$usuario1">
        Titulo <input type="text" name="Titulo">
        Contenido  <textarea name="Contenido" cols="20"rows="10" wrap="type" > </textarea>
        Fecha Registro <input type="date" name="Fecha_Registro" >
        Fecha Vencimiento <input type="date" name= "Fecha_Vencimiento" >
        Prioridad 
        <select name="Prioridad" size="1">
        <option value="Alta"> Alta </options>
        <option value="Baja"> Baja </options>
        </select>

             <input type="submit" value="REGISTRAR">
    <p><a href='logout.php'>
    Click para Cerrar Sesion </a></p><br/>
    </pre></form> 
    _END;

    }
    if (isset($_POST['delete']) && isset($_POST['Titulo']))
    {   
        $Titulo = get_post($conexion, 'Titulo');
        $query = "DELETE FROM tareas WHERE Titulo='$Titulo'";
        $result = $conexion->query($query);
        if (!$result) echo "BORRAR falló"; 
    }


    $query = "SELECT * FROM tareas where usuarios_idusuario=$usuario1 order by Fecha_Vencimiento asc";
    $result = $conexion->query($query);
    if (!$result) die ("Falló el acceso a la base de datos");

    $rows = $result->num_rows;

    for ($j = 0; $j < $rows; $j++)
    {
        $row = $result->fetch_array(MYSQLI_NUM);

        
        $r0 = htmlspecialchars($row[0]);
        $r1 = htmlspecialchars($row[1]);
        $r2 = htmlspecialchars($row[2]);
        $r3 = htmlspecialchars($row[3]);
        $r4 = htmlspecialchars($row[4]);
        $r5 = htmlspecialchars($row[5]);

        echo <<<_END
        <pre>

        Titulo $r1
        Contenido $r2
        Fecha_Registro $r3
        Fecha_Vencimiento $r4
        Prioridad $r5
        </pre>
          </pre>

        <form action='sqltest.php' method='post'>
        <input type='hidden' name='delete' value='yes'>
        <input type='hidden' name='Titulo' value='$r1'>
        <input type='submit' value='BORRAR REGISTRO'></form>

        <form action='archivados.php' method='post'>
        <input type='hidden' name='usuarios_idusuario' value='$r0'>
        <input type='hidden' name='Titulo' value='$r1'>
        <input type='hidden' name='Contenido' value='$r2'>
        <input type='hidden' name='Fecha_Registro' value='$r3'>
        <input type='hidden' name='Fecha_Vencimiento' value='$r4'>
        <input type='hidden' name='Prioridad' value='$r5'>
        <input type='submit' value='archivados'></form>
      

        <form action='Modificar.php' method='post'>
        <input type='hidden' name='Titulo' value='$r1'>
        <input type='date' name='Fecha_Vencimiento' value='$r1'>
        <input type='submit' value='Modificar' Fecha_Vencimiento></form>

        Modificar Contenido
     
        <form action='Modificar2.php' method='post'>
        <input type='hidden' name='Titulo' value='$r1'>
        <textarea name='Contenido'cols="20" rows="10" wrap="type" value='$r1'>
        </textarea>
        <input type='submit' value='Modificar Contenido'></form>
        
        _END;
       
    }

    $result->close();
    $conexion->close();

    function get_post($con, $var)
    {
        return $con->real_escape_string($_POST[$var]);
    }
?>