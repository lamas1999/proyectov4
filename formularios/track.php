<?php
include_once("../clases/conexion.php");
include_once("../clases/usuario.php");
require_once("../clases/ctrl_session.php");
//---------- USES DE LAS CLASES DE NAMESPACES ----
use \clases\ctrl_session\Ctrl_Session;
//-----------------------------------------------
Ctrl_Session::verificar_inicio_session();

use \clases\conexion\Conexion;
use \clases\usuario\Usuario;

$cnx = new Conexion();
$usuario = new Usuario($cnx);

$id = Ctrl_Session::get_id_usuario();
$nombre = "";
$apellido = "";
$imagen = "";

if ($usuario->traerporid($id)) {
    $nombre = $usuario->get_nombre();
    $apellido = $usuario->get_apellido();
    $imagen = $usuario->get_imagen();
}
?>

<?php include("incluir_header.php"); ?>
<?php include("incluir_nav.php"); ?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-globe" aria-hidden="true"></i> Obtner localización</h1>
            <p>Datos de la posisición actual</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
            <li class="breadcrumb-item">Obtner localización</li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <!-- ------------------- -->
                    <p id="display"></p>
                    <p>
                        This is a demo tracking page.
                        You will normally create a rider login page, or convert this into a webapp.
                    </p>
                    <!-- ------------- -->

                </div>
            </div>
        </div>
    </div>
</main>

<?php include("incluir_footer.php"); ?>
</body>

</html>