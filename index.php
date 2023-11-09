<?php 
include('users.php');
$sql = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hola</title>
</head>
<body>
    <table align="center" border="5px" style="width:80%; line-height:30px">
        <th colspan="3"><h2>Usuarios</h2></th>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th>
        </tr>
        <?php while ($row = mysqli_fetch_array($result)) {?>
            <tr>
                <td><?php echo $row['nombre'];?></td>
                <td><?php echo $row['apellido'];?></td>
                <td><?php echo $row['correo'];?></td>
            </tr>  
        <?php }?>

    </table>
</body>
</html>