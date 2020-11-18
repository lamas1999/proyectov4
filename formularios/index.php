<?php
include_once("../clases/conexion.php");
include_once("../clases/usuario.php");
require_once("../clases/ctrl_session.php");
require_once("../clases/track_da.php");/*  */

//---------- USES DE LAS CLASES DE NAMESPACES ----
use \clases\ctrl_session\Ctrl_Session;
//-----------------------------------------------
Ctrl_Session::verificar_inicio_session();

use \clases\conexion\Conexion;
use \clases\usuario\Usuario;
/*  */
use \clases\track_da\Track_da;

$cnx = new Conexion();
$usuario = new Usuario($cnx);
/*  */

$track_da = new Track_da($cnx);

$id = Ctrl_Session::get_id_usuario();
$nombre = "";
$apellido = "";
$imagen = "";

if ($usuario->traerporid($id)) {
    $nombre = $usuario->get_nombre();
    $apellido = $usuario->get_apellido();
    $imagen = $usuario->get_imagen();
}




/*  */
$rider_id = 999;
$latitud = "";
$Longitud = "";


if ($track_da->traerporid($rider_id)) {
    $latidud = $track_da->get_track_lat();
    $longitud = $track_da->get_track_lng();
}
?>

<?php include("incluir_header.php"); ?>

<?php include("incluir_nav.php"); ?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-map-marker" aria-hidden="true"></i> Geolocalizacion</h1>
            <p>Inicia la busqueda en el mapa

            </p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
        </ul>
    </div>

    <div id="map">
        <script src="../assets/js/maps.js"></script>
      <!--  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDy5crOl57-UrPP2tiasS7x_uccPqgjBfM&callback=iniciarMap"></script>  -->
    </div>


</main>

<?php include("incluir_footer.php"); ?>
</body>

</html>