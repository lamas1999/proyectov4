<?php
include_once("clases/conexion.php");
include_once("clases/usuario.php");
include_once("clases/ctrl_session.php");
//---------- USES DE LAS CLASES DE NAMESPACES ----
use \clases\ctrl_session\Ctrl_Session;
use \clases\conexion\Conexion;
use \clases\usuario\Usuario;
//-----------------------------------------------

$cnx = new Conexion();
$usuario = new Usuario($cnx);

$id = 0;
$login = "";
$password = "";

$error = "";

//=================verificnado metodo post
//funciones
function procesarIniciarSession()
{
    //se pone global para acceder a las variables globales desde una funcion
    global $usuario;
    global $login;
    global $password;
    global $error;


    $login = filter_var(strtolower($_POST['txtLogin']), FILTER_SANITIZE_STRING);
    $password = $_POST["txtPassword"];

    if ($usuario->loguear($login, $password) == true) {
        //guardar datos en la session 
        // $_SESSION["login_usuario"]=$login;
        // $_SESSION["id_usuario"] = $cliente->get_id();
        // $_SESSION["nombre_usuario"] = $cliente->get_nombre();
        Ctrl_Session::iniciar_session($login, $usuario->get_id(), $usuario->get_nombre());
        header("location:formularios/index.php?msg=logueado correctamente");
    } else {
        $error = "Error al iniciar revise sus datos de acceso";
    }
}
if (isset($_POST["btnAceptar"])) {
    procesarIniciarSession();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include("incluir_estilos_encabezado.php"); ?>
    <title>Login</title>
</head>
<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <img src="assets/img/logo.png" width="95" height="95" alt="img" srcset="">
        <div class="logo">
            <h1>RossMotors</h1>
        </div>
        <div class="login-box">
             <!-- Form -->
            <form class="login-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Iniciar Seccion</h3>
                <div class="form-group">
                    <label class="control-label">LOGIN</label>
                    <input class="form-control" type="text" id="txtLogin" name="txtLogin" value="<?php echo $login ?>" requiere autofocus>
                </div>
                <div class="form-group">
                    <label class="control-label">PASSWORD</label>
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-eye" id="show"></i></span></div>
                        <input class="form-control" type="password" id="txtPassword" name="txtPassword" value="<?php echo $password ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="utility">

                       <!--  <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Olvidaste tu Password?</a></p> -->
                    </div>
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-dark btn-block" name="btnAceptar" value="Aceptar"><i class="fa fa-sign-in fa-lg fa-fw"></i>INGRESAR</button>
                </div>

                <!--si la varible errores no esta vacia-->
                <?php if (!empty($error)) : ?>

                    <div class="bs-component">
                        <div class="alert alert-dismissible alert-danger">
                            <button class="close" type="button" data-dismiss="alert">×</button><?php echo $error; ?>
                        </div>
                    </div>
                <?php endif ?>
            </form>
             <!-- Form -->
            <!--------------------------------------------------------------------------------------------------- -->

           <!--  <form class="forget-form" action="frmlogin.html">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Reestablcer</h3>
                <div class="form-group">
                    <label class="control-label">EMAIL</label>
                    <input class="form-control" type="text" placeholder="Email">
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESET</button>
                </div>
                <div class="form-group mt-3">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Back to Login</a></p>
                </div>
            </form> -->
            <!-- -------------------------------------------------------------------------------------------------------- -->
        </div>
    </section>
    <?php include("incluir_estilos_pie.php"); ?>
</body>

</html>