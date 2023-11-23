<!DOCTYPE html>
<html>
<head>
    <title>Tabla de usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h2 {
            margin-top: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
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
            echo "<td><a href='editar.php?id=" . $fila["id"] . "'>Editar</a></td>";
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
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM usuarios WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            echo "Registro eliminado correctamente.";
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
</body>
</html>
