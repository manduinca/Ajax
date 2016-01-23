<?php
    //tomamos los valores enviados por ajax usando método get
    $nombre = $_GET["nombre"];
    $email = $_GET["email"];
    
    //nos conectamos a la base de datos, debe tener un usuario (user)
    //y una base de datos (pruebasdb) creados
    $conx = mysqli_connect("127.0.0.1", "user", "password", "pruebasdb");
    if(!$conx) echo "Error de conexion";
   
    //creamos la tabla contacto si no existiera 
    $buscar = mysqli_query($conx, "show tables like 'contacto'");
    if(!mysqli_num_rows($buscar)) {
        $query = "create table contacto(nombre varchar(50), email varchar(50))";
        $res = mysqli_query($conx, $query);
        if(!$res) echo "Error al crear tabla";
    }
    //insertamos los registros en contacto
    $query = "insert into contacto (nombre, email) values ('" 
            . $nombre . "', '" . $email . "')";
    $res = mysqli_query($conx, $query);
    if(!$res) echo "Error al insertar datos";

    //leemos desde la base de datos
    $query = "select * from contacto";
    $res = mysqli_query($conx, $query);
    //escribimos una tabla con los datos
    echo "<table> 
          <tr> 
            <td>Nombre</td>
            <td>Email</td>
          </tr>";
    while($reg = mysqli_fetch_array($res)) {
        echo "<tr>
              <td>" . $reg['nombre'] . "</td>
              <td>" . $reg['email'] . "</td>
              </tr>";
    }
    echo "</table>";
?>
