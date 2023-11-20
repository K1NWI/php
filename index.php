<!DOCTYPE html>
<html>
<head>
    <title>Tabla de usuarios</title>
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
    $sql = "SELECT * FROM nombre_de_la_tabla"; // Cambia 'nombre_de_la_tabla' al nombre de tu tabla
    $result = mysqli_query($conn, $sql);
    // Procesar y mostrar los datos en una tabla
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Nombre</th><th>Correo</th></tr>";
        while ($fila = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $fila["nombre"] . "</td>";
            echo "<td>" . $fila["correo"] . "</td>";
            // Puedes agregar más campos según tu tabla
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No se encontraron resultados en la tabla.";
    }

    // Cerrar la conexión
    mysqli_close($conn);
    ?>   
    <!-- Puedes continuar con más contenido HTML -->
</body>
</html>
