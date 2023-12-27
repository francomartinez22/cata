<?php
include("../../bd.php");

// Eliminar registro
if(isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID'])) ?$_GET['txtID'] : "";

    $sentencia = $conexion->prepare("DELETE FROM tbl_usuarios WHERE ID = :id");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
}

// SELECCIONAR REGISTROS 
$sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios");
$sentencia->execute();
$tbl_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        <a href="crear.php" class="btn btn-primary" role="button">Agregar</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table">
                <thead>
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Contraseña</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tbl_usuarios as $registros): ?>
                        <tr class="">
                            <td scope="row"><?php echo $registros['usuario']; ?></td>
                            <td><?php echo $registros['correo']; ?></td>
                            <td><?php echo $registros['password']; ?></td>
                            <td><a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID']; ?>" role="button">Editar</a> 
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID']; ?>" role="button">Eliminar</a>                                  
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>
