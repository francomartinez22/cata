<?php
include("../../bd.php");

if (isset($_GET['txtID'])) {
    // Recuperamos los datos
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE ID=:id ");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $usuario = $registro['usuario'];
    $correo = $registro['correo'];
    $password = $registro['password'];
}

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        Usuarios
    </div>
    <div class="card-body">

        <form action="" method="post">

            <div class="mb-3">
                <label for="txtID" class="form-label">id</label>
                <input readonly type="text"
                    class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" aria-describedby="helpId" placeholder="" />
            </div>

            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input
                    type="text"
                    class="form-control" value="<?php echo $usuario; ?>" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre Usuario:" />
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password" class="form-control" value="<?php echo $password; ?>" name="password" id="password" aria-describedby="helpId" placeholder="Password" />
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input
                    type="email" class="form-control" value="<?php echo $correo; ?>" name="correo" id="correo" aria-describedby="emailHelpId" placeholder="abc@mail.com" />
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>

    </div>
    <div class="card-footer text-muted">

    </div>
</div>

<?php include("../../templates/footer.php"); ?>
