<?php
var_dump($_POST);
$nombre = '';
$msg = '';

if (isset($_POST['enviar'])) {

    function validacion($campo, $min, $max, $campoName) {
        $msg = '';
        $error = false;
        $campo2 = '';

        if (!isset($_POST[$campo])) {
            $msg = "No existe campo ".$campoName;
            $error = true;
        } else {
            $campo2 = trim($_POST[$campo]);
            if (empty($campo2)) {
                $msg = 'No puede estar vacío el campo '.$campoName;
                $error = true;
            } else {
                if (strlen($campo2) < $min || strlen($campo2) > $max) {
                    $msg = 'Por favor ingrese entre '.$min.' y '.$max.' caracteres';
                    $error = true;
                } else {
                }
            }
        }
        $resultado['msg'] =$msg;
        $resultado['error'] =$error;
        $resultado['campo2'] =$campo2;

        return $resultado;
    }
    function validarCampoAlfabetico($campo) {
        $expresionRegular = '/^[a-zA-ZÀ-ÿ\u00f1\u00d1 ]+$/u';
        return preg_match($expresionRegular, $campo) === 1;
    }
    #VALIDACIONES NOMBRE ######################################################################
    $valNombre = validacion('nombre', 3, 10, 'nombre');

    if ($valNombre['error']) {
        $msg = $valNombre['msg'];
    } else {
        $nombre = $valNombre['campo2'];

        if ($valNombre['error'] == false) {
            $valNombreAlf = validarCampoAlfabetico($nombre);

            if ($valNombreAlf == false) {
                $msg = 'Debe contener solo caracteres alfabéticos';
                $error = true;
            }
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <main class="row flex flex-justify-center">
        <form class="col_4 reg_cont" method="POST">
            <div class="col_12">
                <h1>Registro</h1>
            </div>
            <div class="col_12 inputs">
                <input type="text" name="nombre" placeholder="Ingrese su nombre" 
                pattern="[a-zA-Z']*" value="<?=$nombre?>">
                <output class="col_12 msg_error"><?=$msg?></output>
            </div>
            <div class="col_12 flex flex-justify-center button_reg">
                <button type="submit" name="enviar">Enviar</button>
            </div>
        </form>
    </main>
</body>
</html>