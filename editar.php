<!DOCTYPE html>
<html>
<head>
    <title>Editar usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
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
    // Verificar si se recibió la orden de editar
    if (isset($_GET['id'])) {
        // Obtener el ID del usuario a editar
        $idUsuario = $_GET['id'];

        // Verificar si se recibió la orden de guardar cambios
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtener los nuevos datos del usuario
            $nuevoNombre = $_POST['nombre'];
            $nuevoCorreo = $_POST['correo'];

            // Actualizar los datos del usuario en la base de datos
            $sql = "UPDATE usuarios SET nombre = '$nuevoNombre', correo = '$nuevoCorreo' WHERE id = $idUsuario";
            if (mysqli_query($conn, $sql)) {
                echo "Usuario editado correctamente";
                // Redirigir a index.php
                header("Location: index.php");
                exit();
            } else {
                echo "Error al editar el usuario: " . mysqli_error($conn);
            }
        } else {
            // Consultar los datos del usuario a editar
            $sql = "SELECT * FROM usuarios WHERE id = $idUsuario";
            $result = mysqli_query($conn, $sql);
            $fila = mysqli_fetch_assoc($result);

            // Mostrar el formulario de edición con los datos del usuario
            echo "<form method='post' action='editar.php?id=$idUsuario'>";
            echo "<h2>Editar usuario</h2>";
            echo "<label for='nombre'>Nombre:</label><br>";
            echo "<input type='text' name='nombre' id='nombre' value='" . $fila['nombre'] . "'><br><br>";
            echo "<label for='correo'>Correo:</label><br>";
            echo "<input type='text' name='correo' id='correo' value='" . $fila['correo'] . "'><br><br>";
            echo "<input type='submit' value='Guardar cambios'>";
            echo "</form>";
        }
    } else {
        echo "No se recibió el ID del usuario a editar";
    }

    // Cerrar la conexión
    mysqli_close($conn);
    ?>
</body>
</html>
