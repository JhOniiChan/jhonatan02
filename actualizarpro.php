<?php
include_once 'michichi.php';
$id=$_GET["id"];

$nomp = "";
$desc = "";
$cant = "";
$comp = "";
$vent = "";
$resp = "";
/* ------ */

$accion = @$_GET["accion"];
if($accion=="actualizar")
{
    $nomp = $_POST["txtNombrep"];
    $desc = $_POST["txtDesc"];
    $cant = $_POST["txtCantidad"];
    $comp = $_POST["txtComp"];
    $vent = $_POST["txtVent"];
        
    $pro = ProductosQuery::create()->findPk($id);
    $pro->setNombrepro($_POST["txtNombrep"]);
    $pro->setDescripcion($_POST["txtDesc"]);
    $pro->setCantidad($_POST["txtCantidad"]);
    $pro->setCompra($_POST["txtComp"]);
    $pro->setVenta($_POST["txtVent"]);
   
    $mensaje ="";
    
    if($pro->validate())
    {
        $pro->save();
        $mensaje="Se actualizó el producto seleccionado";
    }
    else{
        foreach($pro->getValidationFailures() as $error){
            $mensaje.="<br>".$error->getMessage();
        }
    }
    echo $mensaje;
}


/* -------- */
$pro = ProductosQuery::create()->findPk($id);
if($pro!=""){
    $nomp = $pro->getNombrepro();
    $desc = $pro->getDescripcion();
    $cant = $pro->getCantidad();
    $comp = $pro->getCompra();
    $vent = $pro->getVenta();
}
else
{
    header("Location: index.php?pagina=pro");
}
?>
<form action="index.php?pagina=proac&accion=actualizar&id=<?php echo $id; ?>" method="POST">
    <label for="nombrep">Nombre:</label><br>
    <input type="text" value="<?php echo $nomp; ?>" id="nombrep" name="txtNombrep" placeholder="Poner nombre del producto"><br>
    
    <label for="descripcion">Descripcion:</label><br>
    <input type="text" value="<?php echo $desc; ?>" id="descripcion" name="txtDesc" placeholder="Poner descripcion del producto"><br>
    
    <label for="cantidad">Cantidad:</label><br>
    <input type="text" value="<?php echo $cant; ?>" id="nombrep" name="txtCantidad" placeholder="Poner cantidad"><br>
    
    <label for="costcomp">Costo-compra:</label><br>
    <input type="text" value="<?php echo $comp; ?>" id="costcomp" name="txtComp" placeholder="Poner costo de compra"><br>
    
    <label for="costovent">Costo-venta:</label><br>
    <input type="text" value="<?php echo $vent; ?>" id="costovent" name="txtVent" placeholder="Poner costo de venta"><br><br>
 
    <input type="submit" value="Guardar">
    <a href="index.php?pagina=pro">Regresar</a>
</form> 
