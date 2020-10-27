<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Inventario de Productos</title>
	<!--<link rel="stylesheet" href="/public_html/sistema/css/reportes.css">-->
	<style type="text/css">
	    .letragrande{font-size:22px;}

        .letrachica{font-size:8px;}

        .letranormal{font-size:12px;}

        table {
            width: 100%;
            font-family:sans-serif; 
            font-size: 10;
            border-collapse: collapse;
        }
        table tr:nth-child(even) {
            background-color: #E6E6E6;
        }
        th {
            border-bottom: 2px solid #0000FF;   
            text-align: center;
            background-color: #2E64FE;
            font-size: 8;
            color: #fff;
            vertical-align: center;
        }
        td {
            padding: 0.1em;
            border:hidden;
        }
        caption {
            padding: 0.1em;
        }
        table td:nth-child(1) {
            width: 10%;
            text-align: center;
        }
        table td:nth-child(2) {
            width: 40%;
            text-align: left;
        }
        table td:nth-child(3) {
            width: 20%;
            text-align: left;
        }
        table td:nth-child(4) {
            width: 10%;
            text-align: center;
        }
        table td:nth-child(5) {
            width: 10%;
            text-align: right;
        }
        @page { margin: 100px 50px 50px 50px; }
        #header { 
            position: fixed; 
            left: 0px; 
            top: -80px; 
            right: 0px; 
            height: 10px; 
            background-color: transparent; 
            text-align: center;
        }
        #footer { 
            position: fixed; 
            left: 0px; 
            bottom: -50px; 
            right: 0px; 
            height: 35px; 
            background-color: #333; 
            color: #fff;
            text-align: center;
        }
        #footer .page:after { 
            content: counter(page); 
        }
	</style>
</head>
<body>

<div id="header">
    <p align="right">Fecha del informe: <?= $date ?></p></p>
    <p class="letragrande">Inventario de Productos</p>
</div>

<!--footer para cada pagina-->
<div id="footer">
    <!--aqui se muestra el numero de la pagina en numeros romanos-->
    <p class="page"></p>
</div>

<div>
    <table>
        <br>
        <br>
        <thead>
          <tr>
            <th>ID</th>
            <th>PRODUCTO</th>
            <th>CATEGORIA</th>
            <th>PRECIO</th>
            <th>STOCK</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        $texto="";
        foreach($data as $prod)
        {    
            if ($texto==NULL)
            {
                //primer registro, cargo primera categoria e imprimo titulo.
                $texto=$prod->proveedor;
                ?>
                <tr>
                    <td></td>
                    <td><strong><?= $texto?></strong></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php
            }
            else
            {
                //pregunto si cambio la categoria.
                if ($texto<>$prod->proveedor)
                    //cambio. Imprimo nueva categoria  
                    {

                    $texto=$prod->proveedor;

                    ?>
              
                        <tr>
                            <td></td>
                            <td><strong><?= $texto?></strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        
                        <?php

                    }
            }?>
            
            <tr>
                <td><?= $prod->idproducto; ?></td>
                <td><?= $prod->nombre; ?></td>
                <td><?= $prod->categoria; ?></td>
                <td><?= $prod->precio; ?></td>
                <td><?= $prod->stockactual; ?></td>
            </tr>
           
            <?php
            
        
        }
        
        ?>

            
        </tbody>
        
        
      </table>
      
</div>
</body>
</html>