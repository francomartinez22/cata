<?php 
include("../../bd.php");

if(isset($_GET['txtID'])){
    // Recuperamos los datos
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";
    
    $sentencia = $conexion->prepare("SELECT * FROM tbl_portafolio WHERE ID=:id ");
    $sentencia->bindParam(':id', $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $titulo = $registro['titulo'];
    $subtitulo = $registro['subtitulo'];
    $imagen = $registro['imagen'];
    $descripcion = $registro['descripcion'];
    $cliente = $registro['cliente'];
    $categoria = $registro['categoria'];
    $url = $registro['url'];
}

if($_POST){
    // Recibe datos del formulario 
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $subtitulo = (isset($_POST['subtitulo'])) ? $_POST['subtitulo'] : "";
    
    $sentencia = $conexion->prepare("UPDATE tbl_portafolio 
    SET 
    titulo=:titulo,
    subtitulo=:subtitulo,
    descripcion=:descripcion,
    cliente=:cliente,
    categoria=:categoria,
    url=:url
    WHERE id=:id ");
    
    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":subtitulo", $subtitulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":cliente", $cliente);
    $sentencia->bindParam(":categoria", $categoria);
    $sentencia->bindParam(":url", $url);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    
    if($_FILES["imagen"]["tmp_name"]!=""){
        $imagen_name = $_FILES["imagen"]["name"];
        $fecha_imagen = new DateTime();
        $nombre_archivo_imagen = $fecha_imagen->getTimestamp() . "_" . $imagen_name;
        
        $tmp_imagen = $_FILES["imagen"]["tmp_name"];
        if($tmp_imagen != ""){
            move_uploaded_file($tmp_imagen, "../../../assets/img/portafolio/".$nombre_archivo_imagen);
        }

        // Actualizar solo si se sube una nueva imagen
        $sentencia = $conexion->prepare("UPDATE tbl_portafolio SET imagen=:imagen WHERE id=:id ");
        $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
    }
}

$mensaje = "Registro modificado.";
header("Location: index.php?mensaje=" . urlencode($mensaje));
exit(); // Detener la ejecución después de la redirección

include("../../templates/header.php");
?>

<div class="card-header">
    Edición de nuestro portafolio
</div>
<div class="card-body">
    <form action="" enctype="multipart/form-data" method="post"> 
        <div class="mb-3">
            <label for="txtID" class="form-label">ID:</label>
            <input type="text" class="form-control" name="txtID" id="txtID" value="<?php echo $txtID; ?>" aria-describedby="helpId" placeholder=""/>
        </div>
    
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input value="<?php echo $titulo;?>" type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Título"/>
        </div>

        <div class="mb-3">
            <label for="subtitulo" class="form-label">Subtítulo</label>
            <input value="<?php echo $subtitulo;?>" type="text" class="form-control" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="Subtítulo"/>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <img width="50" src="../../../assets/img/portafolio/<?php echo $imagen;?>" />
            <input type="file" class="form-control" name="imagen" id="imagen" />
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input value="<?php echo $descripcion;?>" type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Subtítulo"/>
        </div>

        <div class="mb-3">
            <label for="cliente" class="form-label">Cliente</label>
            <input value="<?php echo $cliente;?>" type="text" class="form-control" name="cliente" id="cliente" aria-describedby="helpId" placeholder="Subtítulo"/>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    </form>
</div>
    
<div class="card-footer text-muted">
</div>
</div>

<?php include("../../templates/footer.php");?>
