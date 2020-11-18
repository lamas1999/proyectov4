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
$email = "";
$login = "";
$password = "";
$telefono = "";
$imagen = "";
$error = "";


if ($usuario->traerporid($id)) {
    $nombre = $usuario->get_nombre();
    $apellido = $usuario->get_apellido();
    $email = $usuario->get_email();
    $login = $usuario->get_login();
    $telefono = $usuario->get_telefono();
    $imagen = $usuario->get_imagen();
}

/* **************************************** */
function procesar_modificar()
{ //dentro de la funcio no puedo accedr a las variables globales 
    //si quiero acceder tengo que explicitar con la palabra global
    global $usuario;
    global $nombre;
    global $apellido;
    global $email;
    global $login;
    global $password;
    global $telefono;
    global $imagen;
    global $error;


    ///Si esta vacia el archivo de fotos solo actualiza la informacion 

    if (empty($_FILES['foto']['name'])) {
        $id = $_POST["txtid"];
        $nombre = trim($_POST['txtnombre']);
        $apellido = trim($_POST['txtapellido']);
        $email = trim($_POST['txtemail']);
        $login = filter_var(strtolower($_POST['txtlogin']), FILTER_SANITIZE_STRING);
        $telefono = $_POST['telefono'];

        $usuario->inicializar($id, $nombre, $apellido, $email, $login, null, $telefono, null);
        if ($usuario->modificar_sinImg()) {
            header("location:frmperfil.php?msg=Modificado correctamente!!!");
        } else {
            $error = "Error al modificar revise los datos !!!";
        }
    } else {
        $check = @getimagesize($_FILES['foto']['tmp_name']);

        if ($check !== false) {
            $carpeta_destino = '../fotos/';
            $archivo_subido = $carpeta_destino . $_FILES['foto']['name'];

            move_uploaded_file($_FILES['foto']['tmp_name'], $archivo_subido);

            $id = $_POST["txtid"];
            $nombre = trim($_POST['txtnombre']);
            $apellido = trim($_POST['txtapellido']);
            $email = trim($_POST['txtemail']);
            $login = filter_var(strtolower($_POST['txtlogin']), FILTER_SANITIZE_STRING);
            $telefono = trim($_POST['telefono']);
            $imagen = $_FILES['foto']['name'];

            $usuario->inicializar($id, $nombre, $apellido, $email, $login, null, $telefono, $imagen);
            if ($usuario->modificar()) {
                header("location:frmperfil.php?msg=Modificado correctamente!!!");
            } else {
                $error = "Error al modificar revise los datos !!!";
            }
        }
    }
}

if (isset($_POST["btnaceptar"])) {
    procesar_modificar();
}
?>

<?php include("incluir_header.php"); ?>

<?php include("incluir_nav.php"); ?>

<main class="app-content">
    <div class="row user">
        <div class="col-md-12">
            <div class="profile">
                <div class="info">
                    <?php
                    if ($imagen == "") { ?>
                        <img src="../assets/img/login-default.png" class="img-circle" alt="User Image" />
                    <?php
                    } else { ?>
                        <img src="../fotos/<?php echo $imagen; ?>" class="img-circle" alt="User Image" />
                    <?php
                    }
                    ?>

                    <!-- <img class="user-img" src="../plugin/img/login.png"> -->
                    <h4> <?php echo $nombre; ?></h4>
                    <p><?php echo $apellido; ?></p>
                </div>
                <div class="cover-image"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="tile p-0">
                <ul class="nav flex-column nav-tabs user-tabs">
                    <!-- <li class="nav-item"><a class="nav-link active" href="#user-timeline" data-toggle="tab">Mesajes</a></li> -->
                    <li class="nav-item"><a class="nav-link active" href="#user-settings" data-toggle="tab">Configuración</a></li>
                </ul>
            </div>


        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <!-- -------------------------------------------- -->

                <!-- ----------------------------------------------------------------------- -->
                <div class="tab-pane active" id="user-settings">
                    <div class="tile user-settings">
                        <h4 class="line-head"><i class="fa fa-edit"></i> Modificar Perfil de Usuario</h4>
                        <!-- -------------------FORMULARIO------------------------ -->
                        <!--  <form name="form1" action="frmmlogin.php" method="post"> -->
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" name="form1" method="POST" enctype="multipart/form-data">

                            <input type="hidden" name="txtid" value="<?php echo $id; ?>">

                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label>Nombre</label>
                                    <input class="form-control" type="text" name="txtnombre" id="txtnombre" value="<?php echo $nombre; ?>"  required>
                                </div>
                                <div class="col-md-4">
                                    <label>Apellido</label>
                                    <input class="form-control" type="text" name="txtapellido" id="txtapellido" value="<?php echo $apellido; ?>"  required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 mb-4">
                                    <label>E-mail</label>
                                    <input class="form-control" type="text" name="txtemail" value="<?php echo $email; ?>" id="txtemail" required>
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-md-8 mb-4">
                                    <label>Login</label>
                                    <input type="text" name="txtlogin" value="<?php echo $login; ?>" id="txtlogin" class="form-control" required>
                                </div>

                                <div class="clearfix"></div>
                                <div class="col-md-8 mb-4">
                                    <label>Telefono</label>
                                    <input class="form-control" type="number" name="telefono" value="<?php echo $telefono; ?>" id="telefono" onkeypress="return solonumeros(event)" onpaste="return false" pattern="[0-9]+" required>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-8 mb-4">
                                    <label>Foto</label>
                                    <input class="form-control" type="file" name="foto" id="foto" accept="image/*">
                                </div>
                                <div class="col-md-8 mb-4">
                                    <?php
                                    if ($imagen == "") { ?>
                                        <img style="border:1px solid #eaeaea;border-radius:5px;" src="../assets/img/login-default.png" width="128">
                                    <?php
                                    } else { ?>
                                        <img style="border:1px solid #eaeaea;border-radius:5px;" src="../fotos/<?php echo $imagen; ?>" width="128">
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <!--  -->
                            <div class="tile-footer">
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-3">
                                        <button class="btn btn-primary" type="submit" name="btnaceptar" id="btnaceptar"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="frmperfil.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php if (!empty($error)) : ?>
                            <div class="bs-component">
                                <div class="alert alert-dismissible alert-danger">
                                    <button class="close" type="button" data-dismiss="alert">×</button><?php echo $error; ?>
                                </div>
                            </div>
                        <?php endif ?>
                        <!--------------------------------------------------------------------------------- -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
<?php include("incluir_footer.php"); ?>
</body>

</html>