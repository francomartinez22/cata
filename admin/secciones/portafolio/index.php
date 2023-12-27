<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    // Recuperamos los datos
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("SELECT imagen FROM tbl_portafolio WHERE ID = :id");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $registro_imagen = $sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_imagen["imagen"])){
        if(file_exists("../../../assets/img/portafolio/".$registro_imagen["imagen"])){
            unlink("../../../assets/img/portafolio/".$registro_imagen["imagen"]);
        }
    }
    
    $sentencia = $conexion->prepare("DELETE FROM tbl_portafolio WHERE ID = :id");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
}

// SELECCIONAR REGISTROS 
$sentencia = $conexion->prepare("SELECT * FROM tbl_portafolio");
$sentencia->execute();
$tbl_portafolio = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registros</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Cliente</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tbl_portafolio as $registros): ?>
                        <tr class="">
                            <td scope="col"><?php echo $registros['ID']; ?></td>
                            <td scope="col">
                                <?php echo $registros['titulo'];?>
                                <br>
                                <?php echo $registros['subtitulo'];?>
                            </td>
                           
                            <td scope="col">
                                <img width="50" src="../../../assets/img/portafolio/<?php echo $registros['imagen'];?>"/>
                            </td>
                            <td scope="col"><?php echo $registros['descripcion']; ?></td>
                            <td scope="col"><?php echo $registros['cliente']; ?></td>
                            <td scope="col">
                                <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registros['ID']; ?>" role="button">Editar</a> 
                                <a name="" id="" class="btn btn-danger" href="index.php?txtID=<?php echo $registros['ID']; ?>" role="button">Eliminar</a>                                  
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php");?>
