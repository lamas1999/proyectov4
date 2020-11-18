<?php
include_once("../clases/conexion.php");
include_once("../clases/usuario.php");
require_once("../clases/ctrl_session.php");
//---------- USES DE LAS CLASES DE NAMESPACES ----
use \clases\ctrl_session\Ctrl_Session;
use \clases\conexion\Conexion;
use \clases\usuario\Usuario;
//-----------------------------------------------
Ctrl_Session::verificar_inicio_session();


$cnx = new Conexion();
$usuario = new Usuario($cnx);

$id = Ctrl_Session::get_id_usuario();
$nombre = "";
$apellido = "";
$password = "";
$imagen = "";
$error = "";

$old_pass = "";
$new_pass = "";
$retype_pass = "";


if ($usuario->traerporid($id)) {
    $nombre = $usuario->get_nombre();
    $apellido = $usuario->get_apellido();
    $imagen = $usuario->get_imagen();
    $password = $usuario->get_password();
}

function procesar_modificar_password()
{ //dentro de la funcio no puedo accedr a las variables globales 
    //si quiero acceder tengo que explicitar con la palabra global
    global $usuario;
    global $password;
    global $old_pass;
    global $new_pass;
    global $retype_pass;
    global $error;
    global $id;

    $id = $_POST["txtid"];
    $old_pass = md5(trim($_POST['txtold_pass']));
    $new_pass = trim($_POST['txtnew_pass']);
    $retype_pass = trim($_POST['txtretype_pass']);

    if ($old_pass != $password) {
        $error = "Error no coloco la contarseña correcta!!";
    } else {
        if ($new_pass != $retype_pass) {
            $error = "Error las contarseña no coinciden!!";
        } else {
            $usuario->inicializar($id, null, null, null, null, $new_pass, null, null);
            if ($usuario->modificar_password()) {
                header("location:frmperfil.php?msg=Modificado correctamente!!!");
            } else {
                $error = "Error al modificar revise los datos !!!";
            }
        }
    }
}

if (isset($_POST["btnaceptar"])) {
    procesar_modificar_password();
}

?>

<?php include("incluir_header.php"); ?>
<?php include("incluir_nav.php"); ?>
<!-- ------------------------->
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-lock" aria-hidden="true"></i> Modificar Contarseña</h1>
            <p>Datos</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
            <li class="breadcrumb-item">Modificar Contarseña</li>
        </ul>
    </div>
    <!---------------------->
    <div class="col-md-6">
        <div class="tile">
            <h3 class="tile-title">Password</h3>
            <div class="tile-body">

                <!-- <form class="form-horizontal"> -->
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="form1" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="txtid" value="<?php echo $id; ?>">

                    <div class="form-group row">
                        <label class="control-label col-md-3">Contarseña antigua</label>
                        <div class="col-md-8">
                            <input class="form-control" type="password" id="txtold_pass" name="txtold_pass" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3">Nueva Contarseña</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-eye" id="show"></i></span></div>
                                <input class="form-control" type="password" id="txtPassword" name="txtnew_pass"   required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3">Repetir Contarseña</label>
                        <div class="col-md-8"> 
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-eye" id="showpass"></i></span></div>
                                <input class="form-control" type="password" id="txtretype_pass" name="txtretype_pass" required>
                            </div>
                        </div>
                    </div>

                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-3">
                                <button class="btn btn-primary" type="submit" name="btnaceptar" id="btnaceptar"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="index.php."><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="tile-footer">
                    <?php if (!empty($error)) : ?>
                        <div class="bs-component">
                            <div class="alert alert-dismissible alert-danger">
                                <button class="close" type="button" data-dismiss="alert">×</button><?php echo $error; ?>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
                <!---->
            </div>
        </div>
    </div>
    <!--------------->
</main>
<!-- --------------------->
<?php include("incluir_footer.php"); ?>
</body>

</html>