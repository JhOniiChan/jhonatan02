<?php
include_once 'michichi.php';
$id=$_GET["id"];
$nomc = "";
$apec = "";
$dire = "";
$telc = "";
$corc = "";
$cla = "";
/* ------ */

$accion = @$_GET["accion"];
if($accion=="actualizar")
{
    $nomc = $_POST["txtNombrec"];
    $apec = $_POST["txtApellidoc"];
    $dire = $_POST["txtDireccion"];
    $telc = $_POST["txtTelefonoc"];
    $corc = $_POST["txtCorreoc"];
    $cla = $_POST["txtClasificacion"];
    
    $cli = ClientesQuery::create()->findPk($id);
    $cli->setNombreclie($_POST["txtNombrec"]);
    $cli->setApellidoclie($_POST["txtApellidoc"]);
    $cli->setDireccion($_POST["txtDireccion"]);
    $cli->setGeneroclie($_POST["radGeneroc"]);
    $cli->setTelefonoclie($_POST["txtTelefonoc"]);
    $cli->setCorreoclie($_POST["txtCorreoc"]);
    $cli->setClasificacion($_POST["txtClasificacion"]);
    
    $mensaje ="";

    if($cli->validate())
    {
        $cli->save();
        $mensaje="Se actualizó cliente";
    }
    else{
        foreach($usu->getValidationFailures() as $error){
            $mensaje.="<br>".$error->getMessage();
        }
    }
    echo $mensaje;
}


/* -------- */
$cli = ClientesQuery::create()->findPk($id);
if($cli!=""){
    $nomc = $cli->getNombreclie();
    $apec = $cli->getApellidoclie();
    $dire = $cli->getDireccion();
    $telc = $cli->getTelefonoclie();
    $corc = $cli->getCorreoclie();
    $cla = $cli->getClasificacion();
}
else
{
    header("Location: index.php?pagina=clie");
}
?>
<form action="index.php?pagina=clieac&accion=actualizar&id=<?php echo $id; ?>" method="POST">
    <label for="nombrec">Nombre(s):</label><br>
    <input type="text" value="<?php echo $nomc; ?>" id="nombrec" name="txtNombrec" placeholder="Poner nombre"><br>
    <label for="apellidoc">Apellido(s):</label><br>
    <input type="text" value="<?php echo $apec; ?>" id="apellidoc" name="txtApellidoc" placeholder="Poner apellido"><br>
    <label for="direccion">Direccion:</label><br>
    <input type="text" value="<?php echo $dire; ?>" id="direccion" name="txtDireccion" placeholder="Poner direccion"><br>
    <label for="generoc">Género:</label><br>
    <label><input type="radio" value="FE" name="radGeneroc">Femenino</label>
    <label><input type="radio" value="MA" name="radGeneroc">Masculino</label><br>
    <label for="telefonoc">Teléfono:</label><br>
    <input type="text" value="<?php echo $telc; ?>" id="telefonoc" name="txtTelefonoc" placeholder="Poner Num. Telefonico"><br>        
    <label for="correoc">Correo electrónico:</label><br>
    <input type="text" value="<?php echo $corc; ?>" id="correoc" name="txtCorreoc" placeholder="Poner correo"><br>
    <label for="clasificacion">Clasificacion:</label><br>
    <input type="text" value="<?php echo $cla; ?>" id="clasificacion" name="txtClasificacion" placeholder="Poner clasificacion"><br>
    <br>
    <input type="submit" value="Guardar">
    <a href="index.php?pagina=clie">Regresar</a>
</form> 
