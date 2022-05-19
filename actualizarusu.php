<?php
include_once 'michichi.php';
$id=$_GET["id"];
$nom = "";
$ape = "";
$cor = "";
$tel = "";
/* ---PRUEBA GIT--- */

$accion = @$_GET["accion"];
if($accion=="actualizar")
{
    $nom = $_POST["txtNombres"];
    $ape = $_POST["txtApellidos"];
    $cor = $_POST["txtCorreo"];
    $tel = $_POST["txtTelefono"];
    $usu = UsuariosQuery::create()->findPk($id);
    $usu->setNombres($_POST["txtNombres"]);
    $usu->setLosApellidos($_POST["txtApellidos"]);
    $usu->setCorreo($_POST["txtCorreo"]);
    $usu->setTelefono($_POST["txtTelefono"]);
    $usu->setEstaVacunado($_POST["radVacunado"]);
    $usu->setQueGenero($_POST["radGenero"]);
    
    $mensaje ="";

    if($usu->validate())
    {
        $usu->save();
        $mensaje="Se actualizó";
    }
    else{
        foreach($usu->getValidationFailures() as $error){
            $mensaje.="<br>".$error->getMessage();
        }
    }
    echo $mensaje;
}


/* -------- */
$usu = UsuariosQuery::create()->findPk($id);
if($usu!=""){
    $nom = $usu->getNombres();
    $ape = $usu->getLosApellidos();
    $cor = $usu->getCorreo();
    $tel = $usu->getTelefono();
}
else
{
    header("Location: index.php?pagina=usu");
}
?>
<form action="index.php?pagina=usuac&accion=actualizar&id=<?php echo $id; ?>" method="POST">
    <label for="nombre">Nombre(s):</label><br>
    <input type="text" value="<?php echo $nom; ?>" id="nombre" name="txtNombres" placeholder="Pon tu nombre"><br>
    <label for="apellido">Apellido(s):</label><br>
    <input type="text" value="<?php echo $ape; ?>" id="apellido" name="txtApellidos"><br>
    <label for="correo">Correo electrónico:</label><br>
    <input type="text" value="<?php echo $cor; ?>" id="correo" name="txtCorreo"><br>
    <label for="telefono">Teléfono:</label><br>
    <input type="text" value="<?php echo $tel; ?>" id="telefono" name="txtTelefono"><br><br>
    <label for="vacunado">Vacunado:</label>
    <label><input type="radio" value="Si" name="radVacunado">Si</label>
    <label><input type="radio" value="No" name="radVacunado">No</label><br><br>
    <label for="genero">Género:</label><br>
    <label><input type="radio" value="Mujer" name="radGenero">Femenino</label>
    <label><input type="radio" value="Hombre" name="radGenero">Masculino</label><br>
    <br>
    <input type="submit" value="Guardar">
    <a href="index.php?pagina=usu">Regresar</a>
</form> 
