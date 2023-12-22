<?php 
include("admin/bd.php");

// SELECCIONAR REGISTROS 
$sentencia = $conexion->prepare("SELECT * FROM tbl_portafolio");
$sentencia->execute();
$lista_servicios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");?>

<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registros</a>
    </div>
    <div class="card-body">
    
    <div
        class="table-responsive-sm"
    >
        <table
            class="table table"
        >
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Subtitulo</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Categoría</th>
                    <th scope="col">Url</th>
                    <th scope="col">Acciones</th>
                	



                </tr>
            </thead>
            <tbody>
                <tr class="">
                    <td scope="col">1</td>
                    <td scope="col">Cata de Entrada</td>
                    <td scope="col">Esta es la CATA con la podras comenzar a sumergirte en el mundo de los vinos</td>
                    <td scope="col">imagen.jpg</td>
                    <td scope="col">Descripción</td>
                    <td scope="col">Cata Entrada</td>
                    <td scope="col">Cata</td>
                    <td scope="col">Url</td>
                    <td scope="col">Editar!Eliminar</td>
                	
                </tr>
                
            </tbody>
        </table>
    </div>
    



    </div>
    
</div>

<?php include("../../templates/footer.php");?>