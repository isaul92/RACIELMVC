<?php

class utilidades {

    public static function countCommentsNews($id) {
        $comentarios = new comentariosNoticiasModel();

        $comentarioss = $comentarios->obtenerNumeroDeComentatios($id);
        $comentaio = $comentarioss->fetch_object();

        return $comentaio->numero;
    }

    public static function getComments($id) {
        $comentarios = new comentariosNoticiasModel();

        $comentarios = $comentarios->obtenerComentatiosNoticia($id);
      

        return $comentarios;
    }

    public static function mostrarFormulario() {
        echo '
		<form name="frmCombos" method="post" action="index.php">
			<table border="0">
				<tr>
					<td>Estado:</td>
					<td>' . utilidades::llenarEstados() . '</td>
					<td>Municipios:</td>
					<td>' . utilidades::llenarMunicipios() . '</td>
				</tr>
				<tr>
					<td>Total:</td>
					<td colspan="3"><input type="text" name="totalMunicipios" id="totalMunicipios" /></td>
				</tr>
				<tr>
					<td colspan="4"><textarea cols="35" rows="10" name="areaTexto">Esta es una prueba para cargar los combos</textarea></td>
				</tr>
				<tr>
					<td colspan="4">&nbsp;</td>
				</tr>
				<tr>
					<td><input type="hidden" name="rutear" value="1" /></td>
					<td colspan="3" align="right"><input type="submit" value="Enviar informaci&oacute;n" /></td>
				</tr>
			</table>
		</form>
		';
    }
    

    public static function llenarMunicipios() {
        require_once 'config/dataBase.php';
        $conexion = Connect::conectar();
        $query = "SELECT clave, idEstado, municipio FROM Municipios WHERE idEstado > 0 ORDER BY municipio ASC;";
        $consulta = $conexion->query($query);
        $combo = "";

        if (Connect::num_rows($consulta) > 0) {
            $combo = '<select class="form-control" id="cmbMunicipios">';
            $i = 0;
            echo "<script language='javascript'>\n";
            while ($resultados = Connect::fetch_array($consulta)) {
                echo "codMunicipios[" . $i . "] = " . $resultados[0] . ";\n";
                echo "idEstado[" . $i . "] = " . $resultados[1] . ";\n";
                echo "municipios[" . $i . "] = '" . $resultados[2] . "';\n";
                $i++;
            }
            echo "</script>\n";
            $combo .= "</select>\n";
        }
        return $combo;
    }

    public static function llenarEstados() {
        require_once 'config/dataBase.php';
        $conexion = Connect::conectar();
        $query = "SELECT idEstado, estado FROM Estados WHERE idEstado > 0 ORDER BY estado ASC;";

        $consulta = $conexion->query($query);
        $combo = "";
        $i = 0;
        if (Connect::num_rows($consulta) > 0) {
            $combo = '<select id="cmbEstados"  class="form-control" onchange="cargarMunicipios(value);">';
            while ($resultados = Connect::fetch_array($consulta)) {
                if ($i == 0)
                    $combo .= '<option id="estado" value="-1">Selecciona...</option>' . "\n";
                $combo .= '<option id="municipio" value="' . $resultados[0] . '">' . $resultados[1] . "</option>\n";
                $i++;
            }
            $combo .= "</select>\n";
        }
        return $combo;
    }

    public static function eliminarSession($nombre) {
        if (isset($_SESSION)) {
            unset($_SESSION[$nombre]);
            $_SESSION[$nombre] = null;
        }
        return $nombre;
    }

    public function formatearPrecio($numero) {
        $número_formato_inglés = number_format($número);

        return $número_formato_inglés;
    }

    public static function paginacion($pagination, $numeroElementos, $numeroDeElementosPagina) {

        //numero total de elementos a paginar 
        $pagination->records($numeroElementos);
        //numero de elementos por pagina
        $pagination->records_per_page($numeroDeElementosPagina);
        $page = $pagination->get_page();
        return $empiezaAqui = (($page - 1) * $numeroDeElementosPagina);
    }

    public static function mostrarError($errores, $campo) {
        $alerta = "";
        if (isset($errores[$campo]) && !empty($campo)) {
            $alerta = "<div class='btn btn-block btn-danger disabled '>" . $errores[$campo] . "</div>";
        }
        return $alerta;
    }

    public static function borrarErrores() {
        $_SESSION['errores'] = null;
    }

    public static function isAdmin() {
        if (!isset($_SESSION["admin"])) {
            header("Location:" . base_url);
        }
        return true;
    }

    public static function isLogger() {
        if (!isset($_SESSION["identity"])) {
            header("Location:" . base_url);
        }
        return true;
    }

    public static function showCategorias() {
        require_once 'models/categoriasModelo.php';
        $categoria = new categoriasModelo();
        $categorias = $categoria->getAll();

        return $categorias;
    }

    public static function statsCarrito() {
        $stats = array(
            "count" => 0,
            "total" => 0
        );
        if (isset($_SESSION["carrito"])) {
            $stats["count"] = count($_SESSION["carrito"]);
            foreach ($_SESSION["carrito"] as $index => $producto) {
                $stats["total"] += $producto["precio"] * $producto["unidades"];
            }
        }
        return $stats;
    }

    public static function showStatus($status) {
        $value = "Pendiete";
        if ($status == "confirm") {
            $value = "Pendiete";
        } elseif ($status == "preparation") {
            $value = "En preparacion";
        } elseif ($status == "ready") {
            $value = "Preparado para enviar";
        } elseif ($status == "send") {
            $value = "Enviado";
        }elseif ($status == "cancel") {
            $value = "Cancelado";
        }
        return $value;
    }

}
