<?php
include("../../bd.php");

if ($_POST) {
    // Recepción de los datos
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : "";
    $subtitulo = (isset($_POST['subtitulo'])) ? $_POST['subtitulo'] : "";
    
    $imagen = (isset($_FILES["imagen"]["name"])) ? $_FILES["imagen"]["name"] : "";

    $descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : "";
    $cliente = (isset($_POST['cliente'])) ? $_POST['cliente'] : "";
    $categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : "";
    $url = (isset($_POST['url'])) ? $_POST['url'] : "";

    $fecha_imagen = new DateTime();
    $nombre_archivo_imagen = ($imagen == "") ? $fecha_imagen->getTimestamp() . "" . $imagen : "";

    $temp_imagen = $_FILES["imagen"]["tmp_name"];
    if (!empty($temp_imagen)) {
        move_uploaded_file($temp_imagen, "../../../assets/img/portafolio/" . $nombre_archivo_imagen);
    }

    $sentencia = $conexion->prepare("INSERT INTO `tbl_portafolio` 
    (`ID`, `titulo`, `subtitulo`, `imagen`, `descripcion`, `cliente`, `categoria`, `url`) 
    VALUES (NULL, :titulo, :subtitulo, :imagen, :descripcion, :cliente, :categoria, :url);");

    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":subtitulo", $subtitulo);
    $sentencia->bindParam(":imagen", $nombre_archivo_imagen);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":cliente", $cliente);
    $sentencia->bindParam(":categoria", $categoria);
    $sentencia->bindParam(":url", $url);

    $sentencia->execute();
}

include("../../templates/header.php");
?>

<div class="card">
    <div class="card-header">
        Productos de nuestro portafolio.
    </div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Título" />
            </div>
            <div class="mb-3">
                <label for="subtitulo" class="form-label">Subtitulo:</label>
                <input type="text" class="form-control" name="subtitulo" id="subtitulo" aria-describedby="helpId" placeholder="Subtitulo" />
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" name="imagen" id="imagen" placeholder="Imagen" aria-describedby="fileHelpId" />
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripción" />
            </div>
            <div class="mb-3">
                <label for="cliente" class="form-label">Clientes:</label>
                <input type="text" class="form-control" name="cliente" id="cliente" aria-describedby="helpId" placeholder="Clientes" />
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categorias:</label>
                <input type="text" class="form-control" name="categoria" id="categoria" aria-describedby="helpId" placeholder="Categorias" />
            </div>
            <div class="mb-3">
                <label for="url" class="form-label">URL:</label>
                <input type="text" class="form-control" name="url" id="url" aria-describedby="helpId" placeholder="URL del proyecto" />
            </div>
            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>

<?php include("../../templates/footer.php");?>
