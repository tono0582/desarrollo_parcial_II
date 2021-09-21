<!doctype html>
<html lang="en">
  <head>
    <title>PRODUCTOS</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>
  <body>
  <?php
        include("datos_conexion.php");
        $id = $_GET['id'];
        $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
        $db_conexion ->real_query("SELECT * from productos where idProductos=".$id."");
        $resultado = $db_conexion->use_result();     
        while($fila = $resultado->fetch_assoc()){                           

  ?>      
      <h1>Editar Productos</h1>
      <div class="container">     
        <form class="d-flex" action="" method="post">
            <div class="col">
                <div class="mb-3">
                    <label for="lbl_codigo" class="form-label"><b>Producto</b></label>
                    <input type="text" name="txt_producto" id="txt_producto" class="form-control" value="<?php echo $fila['producto'] ?>" required>                 
                </div>
                <div class="mb-3">
                  <label for="lbl_marca" class="form-label"><b>Marca</b></label>
                  <select class="form-select" name="drop_marca" id="drop_marca" >
                    <option value=0>---- Marca ----</option>
                    <?php
                    include("datos_conexion.php");
                    $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
                    $db_conexion ->real_query("select idMarca as id, marca from marcas;");
                    $resultado = $db_conexion->use_result();
                    while($row = $resultado->fetch_assoc()){
                        if($fila['idMarca'] == $row['id'])
                        echo"<option selected='selected' value=".$row['id'].">". $row['marca'] ."</option>";
                        else
                        echo"<option value=".$row['id'].">". $row['marca'] ."</option>";
                    }                                        
                    ?>
                  </select>
                </div>                              
                <div class="mb-3">
                    <label for="lbl_descripcion" class="form-label"><b>Descripcion</b></label>
                    <input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control" value="<?php echo $fila['Descripcion'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_costo" class="form-label"><b>Costo</b></label>
                    <input type="number" name="txt_costo" id="txt_costo" class="form-control" value="<?php echo $fila['precio_costo'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="lbl_venta" class="form-label"><b>Venta</b></label>
                    <input type="number" name="txt_venta" id="txt_venta" class="form-control" value="<?php echo $fila['precio_venta'] ?>" required>
                </div>                
                <div class="mb-3">
                    <label for="lbl_existencia" class="form-label"><b>Existencia</b></label>
                    <input type="text" name="txt_existencia" id="txt_existencia" class="form-control" value="<?php echo $fila['existencia'] ?>" required>
                </div>     
                <div class="mb-3">
                    <input type="submit" name="btn_editar" id="btn_editar" class="btn btn-primary" value="Editar">
                </div>                
            </div>
        </form>
      </div>

    <?php
    }
    $db_conexion ->close(); 

    ?>

<?php 
    if(isset($_POST["btn_editar"])){
        include("datos_conexion.php");
        $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
        $txt_producto =utf8_decode( $_POST["txt_producto"]);
        $drop_marca =utf8_decode( $_POST["drop_marca"]);
        $txt_descripcion =utf8_decode( $_POST["txt_descripcion"]);
        $txt_costo =utf8_decode( $_POST["txt_costo"]);
        $txt_venta =utf8_decode( $_POST["txt_venta"]);
        $txt_existencia =utf8_decode( $_POST["txt_existencia"]);
        $sql="UPDATE productos SET producto='".$txt_producto."',idMarca='".$drop_marca."',Descripcion='".$txt_descripcion."',precio_costo='".$txt_costo."',precio_venta='".$txt_venta."',existencia='".$txt_existencia."'
        WHERE idProductos=".$id.";";
        if($db_conexion->query($sql)===true){
            $db_conexion ->close();
            echo"Exito";
            echo '<script language="javascript">alert("Producto Editado con Exito");</script>';
            print "<script>window.setTimeout(function() { window.location = '/productos_parcial2/index.php' }, 1);</script>";
        }else{
            echo"Error" . $sql . "<br>".$db_conexion ->close();

        }

    }

?>    
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  </body>
</html>