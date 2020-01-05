<?php

require_once 'controllers/direccionesUserController.php';
require_once 'models/usuariosModelo.php';

class usuarioController {

    public function index() {
        require_once 'views/layout/nosotros.php';
    }

    public function registro() {
        require_once 'views/usuarioViews/registroUsuario.php';
    }

    public function gestion(){
        utilidades::isAdmin();
        
        
        $user=new usuarioModelo();
        $user=$user->getAll();
        
        
        
        
          require_once 'views/usuarioViews/gestionViews.php';
          
    }
    
    
    
    public function saveUsuario() {
        $conexion = Connect::conectar();
        $errores = array();
        if (isset($_POST)) {
            $nombre = trim($_POST["nombre"]);
            $apellidos = trim($_POST["apellidos"]);
            $email = trim($_POST["email"]);
            $contraseña = trim($_POST["password"]);
            $nombre = !empty($_POST["nombre"]) ? mysqli_real_escape_string($conexion, $_POST["nombre"]) : FALSE;
            $apellidos = !empty($_POST["apellidos"]) ? mysqli_real_escape_string($conexion, $_POST["apellidos"]) : FALSE;
            $email = !empty($_POST["email"]) ? mysqli_real_escape_string($conexion, $_POST["email"]) : FALSE;
            $contraseña = !empty($_POST["password"]) ? mysqli_real_escape_string($conexion, $_POST["password"]) : FALSE;
            if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
                $nombreValidado = true;
            } else {
                $nombreValidado = FALSE;
                echo 'El nombre  no es valido';
                $errores["nombre"] = "el nombre no es valido";
            }
            if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
                $apellidosValidado = true;
            } else {
                $apellidosValidado = false;
                echo 'Los apellidos no son validos';
                $errores["apellidos"] = "los apellidos no son validos";
            }

            if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailvalidado = true;
            } else {
                $emailvalidado = false;
                $errores["email"] = "el email no es valido";
                echo 'El email no es valido';
            }

            if (!empty($contraseña)) {
                $contavalidado = true;
            } else {

                $contavalidado = false;
                $errores["pass"] = "la contraseña no es valida";
                //echo "la contraseña esta vacia";
            }


            if (count($errores) == 0) {
                echo count($errores);

                $usuario = new usuarioModelo();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($contraseña);
                $usuario->setImage("");
                $save = $usuario->save();

                if ($save) {
                    echo '<h1>Registro completo</h1>';
                    $_SESSION["register"] = "complete";
                } else {
                    $_SESSION["register"] = "failed";
                }
            } else {
                $_SESSION["errores"] = $errores;
                $_SESSION["register"] = "failed";
            }
        }
        header("Location:" . base_url . "usuario/registro");
               header("Location:" . base_url);
        echo"<script language='javascript'>window.location='".base_url . "usuario/registro"."'</script>;";
        exit;
    }

    public function login() {

        if (isset($_POST)) {
            //IDENTIFICAR AL USUARIO
            //CONSULTA A LA BASE DE DATOS
            $usuario = new usuarioModelo();
            $usuario->setEmail($_POST["email"]);
            $usuario->setPassword($_POST["password"]);
            $identity = $usuario->login();
            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;

                if ($identity->rol == "admin") {
                    $_SESSION["admin"] = true;
                } else {
                    $_SESSION["user"] = true;
                }
            } else {

                $_SESSION["error_login"]["Identificacion fallida"];
            }
            //CREAR UNA SESION     
        }
        header("Status: 301 Moved Permanently");
      echo"<script language='javascript'>window.location='".base_url ."'</script>;";
        exit;
    }

    public function miPerfil() {
        utilidades::isLogger();

        $misDirecciones = new direccionesUserController();
        $misDirecciones = $misDirecciones->getMyAdresses($_SESSION["identity"]->id);
        require_once 'views/usuarioViews/perfilView.php';
    }

    public function loggearse() {
        require_once 'views/usuarioViews/login.php';
    }

    public function logout() {
        if (isset($_SESSION["identity"])) {
            unset($_SESSION["identity"]);
            $_SESSION["identity"] = null;
        }
        if (isset($_SESSION["admin"])) {
            unset($_SESSION["admin"]);
            $_SESSION["admin"] = null;
        }
        if (isset($_SESSION["user"])) {
            unset($_SESSION["user"]);
            $_SESSION["user"] = null;
        }
        header("Status: 301 Moved Permanently");
        header("Location:" . base_url);
        echo"<script language='javascript'>window.location='index.php'</script>;";
        exit();
    }

    public function update() {
        utilidades::isLogger();

        $conexion = Connect::conectar();
        $errores = array();
        if (isset($_POST)) {
            $telefono = $_POST["telefono"];
            $telefonoAlternativo = $_POST["telefonoAlternativo"];
            $nombre = trim($_POST["nombre"]);
            $apellidos = trim($_POST["apellidos"]);
            $email = trim($_POST["email"]);
            $contraseña = trim($_POST["password"]);
            $contraseña = $_POST["password"] == $_POST["password2"] ? true : $errores["pass"] = "Las Contraseñas no Coinciden";
            $nombre = !empty($_POST["nombre"]) ? mysqli_real_escape_string($conexion, $_POST["nombre"]) : FALSE;
            $apellidos = !empty($_POST["apellidos"]) ? mysqli_real_escape_string($conexion, $_POST["apellidos"]) : FALSE;

            if (!empty($_POST["password"])) {
                $contraseña = !empty($_POST["password"]) ? mysqli_real_escape_string($conexion, $_POST["password"]) : FALSE;
            }
            if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
                $nombreValidado = true;
            } else {
                $nombreValidado = FALSE;
                echo 'El nombre  no es Valido';
                $errores["nombre"] = "El Nombre no es Valido";
            }
            if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
                $apellidosValidado = true;
            } else {
                $apellidosValidado = false;
                echo 'Los Apellidos no son Validos';
                $errores["apellidos"] = "Los Apellidos no son Validos";
            }

            if (!empty($contraseña)) {
                $contavalidado = true;
            } else {

                $contavalidado = false;
                $errores["pass"] = "La Contraseña no es Valida";
                //echo "la contraseña esta vacia";
            }

            if (count($errores) == 0) {
                echo count($errores);
                $usuario = new usuarioModelo();
                $usuario->setNombre($nombre);
                $usuario->setId($_SESSION["identity"]->id);
                $usuario->setApellidos($apellidos);
                $usuario->setTelefono($telefono);
                $usuario->setTelefonoAlternativo($telefonoAlternativo);


                if (!empty($_POST["password"])) {
                    $usuario->setPassword($contraseña);
                    $password = $usuario->getPassword();
                } else {
                    $password = $_SESSION["identity"]->password;
                }


                $usuario->setImage("");
                $save = $usuario->update($password);

                if ($save) {
                    echo '<h1>Actualizacion completo</h1>';
                    $_SESSION["update"] = "complete";
                    $_SESSION['identity']->nombre = $nombre;
                    $_SESSION['identity']->apellidos = $apellidos;
                    $_SESSION['identity']->telefono = $telefono;
                    $_SESSION['identity']->telefonoAlternativo = $telefonoAlternativo;
                } else {
                    $_SESSION["update"] = "failed";
                }
            } else {
                $_SESSION["errores"] = $errores;
                $_SESSION["update"] = "failed";
            }
        }
        header("Location:" . base_url . "usuario/miPerfil");
           echo"<script language='javascript'>window.location='".base_url . "usuario/miPerfil"."'</script>;";
    }

}
?>

