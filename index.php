<!DOCTYPE html>
<html>
<head>
    <title>Tabla de usuarios</title>
        <style>
         body {
    font-family: 'Times New Roman', serif;
    margin: 0;
    padding: 0;
    background-color: #e6e6e6; /* Cambia el color de fondo */
}

h2 {
    margin-top: 30px;
    color: #990000; /* Cambia el color del título */
}

table {
    border-collapse: separate;
    border-spacing: 10px;
    width: 80%;
    margin: 20px auto;
}

th, td {
    border: 2px dashed #666;
    padding: 12px;
    text-align: center;
}

th {
    background-color: #ffd700;
    color: #660066; /* Cambia el color del encabezado de la tabla */
}

tr:nth-child(even) {
    background-color: #cccccc;
}

form {
    margin-top: 30px;
    text-align: center;
}

label {
    display: inline-block;
    margin-bottom: 10px;
    color: #336699; /* Cambia el color de las etiquetas */
}

input[type="text"] {
    width: 60%;
    padding: 8px;
    margin-bottom: 15px;
    border: 2px solid #336699;
}

input[type="submit"] {
    padding: 12px 24px;
    background-color: #ff4500;
    color: white;
    border: 2px solid #cc3300;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #cc3300;
}

        </style>

    </head>
<body>
    <?php
    // Datos de conexión a la base de datos
    $host = "localhost"; // Cambia a la dirección de tu servidor MySQL
    $usuario = "kini";
    $contrasena = "1234";
    $base_de_datos = "Trabajadores3";
    // Conexión a la base de datos
    $conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);
    // Verificar la conexión
    if (!$conn) {
        die("Error en la conexión: " . mysqli_connect_error());
    }
    // Consulta SQL para obtener datos de la tabla
    $sql = "SELECT * FROM usuarios"; // Cambia 'usuarios' al nombre de tu tabla
    $result = mysqli_query($conn, $sql);
    // Procesar y mostrar los datos en una tabla
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Nombre</th><th>Correo</th><th>Acciones</th></tr>";
        while ($fila = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $fila["nombre"] . "</td>";
            echo "<td>" . $fila["correo"] . "</td>";
            echo "<td><a href='?id=" . $fila["id"] . "&action=delete'>Eliminar</a> | <a href='editar.php?id=" . $fila["id"] . "'>Editar</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados en la tabla.";
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $sql = "INSERT INTO usuarios (nombre, correo) VALUES ('$nombre', '$correo')";
        if (mysqli_query($conn, $sql)) {
            echo "Nuevo registro creado correctamente.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    if(isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
        $id = $_GET['id'];
        $sql = "DELETE FROM usuarios WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            echo "Registro eliminado correctamente.";
            // Redireccionar a la página actual para evitar la creación de un nuevo usuario al refrescar la página
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Cerrar la conexión
    mysqli_close($conn);
    ?>   
    <form method="post" action="<?php echo $_SERVER ['PHP_SELF']; ?>" aling="center">
     <h2>Agregar nuevo usuario</h2>   
        <label for ="nombre">Nombre:</label><br>
        <input type="text" name="nombre" id="nombre"><br>
        <br>
        <label for ="correo">Correo:</label><br>
        <input type="text" name="correo" id="correo"><br>
        <br>
        <input type="submit" value="Agregar">
    </form>

    <?php
    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $sql = "SELECT * FROM usuarios WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $nombre = $row['nombre'];
            $correo = $row['correo'];
            echo "<h2>Editar usuario</h2>";
            echo "<form method='post' action='editar.php'>";
            echo "<input type='hidden' name='id' value='$id'>";
            echo "<label for='nombre'>Nombre:</label><br>";
            echo "<input type='text' name='nombre' id='nombre' value='$nombre'><br>";
            echo "<br>";
            echo "<label for='correo'>Correo:</label><br>";
            echo "<input type='text' name='correo' id='correo' value='$correo'><br>";
            echo "<br>";
            echo "<input type='submit' value='Guardar'>";
            echo "</form>";
        } else {
            echo "No se encontró el usuario.";
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $correo = $_POST['correo'];
        $sql = "UPDATE usuarios SET nombre='$nombre', correo='$correo' WHERE id=$id";
        if(mysqli_query($conn, $sql)) {
            echo "Usuario actualizado correctamente.";
        } else {
            echo "Error al actualizar el usuario: " . mysqli_error($conn);
        }
    }
    ?>
</body>
</html>

