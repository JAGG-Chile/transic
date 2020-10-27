<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte Ventas Por Producto</title>
	<style>

.letragrande{font-size:22px;}

.letrachica{font-size:8px;}

.letranormal{font-size:12px;}


table {
    width: 100%;
    font-family:sans-serif; 
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
    
    
    padding: 0.3em;
    border:hidden;
}


caption {
    padding: 0.3em;
}

    table td:nth-child(1) {
        width: 10%;
        text-align: center;
    }
    
    table td:nth-child(2) {
        width: 5%;
        text-align: left;
    } 
    table td:nth-child(3) {
        width: 5%;
        text-align: left;
    }
     
    table td:nth-child(4) {
        width: 20%;
        text-align: left;
    }
    table td:nth-child(5) {
        width: 5%;
        text-align: center;
    }
    table td:nth-child(6) {
        width: 20%;
        text-align: left;
    }
     
    table td:nth-child(7) {
        width: 5%;
        text-align: center;
    }
     
    table td:nth-child(8) {
        width: 5%;
        text-align: right;
    }
    table td:nth-child(9) {
        width: 5%;
        text-align: center;
    }
    table td:last-child {
        width: 10%;
        text-align: right;
    }
   
     /* estilos para el footer y el numero de pagina */
        @page { margin: 180px 50px; }
        #header { 
            position: fixed; 
            left: 0px; 
            top: -160px; 
            right: 0px; 
            height: 35px; 
            background-color: transparent; 
            color: #fff;
            text-align: left; 
        }
        #footer { 
            position: fixed; 
            left: 0px; 
            bottom: -180px; 
            right: 0px; 
            height: 35px; 
            background-color: #333; 
            color: #fff;
            text-align: center;
        }
        #footer .page:after { 
            content: counter(page); 
        }
        
        
        #content { 
            position: fixed; 
            left: 0px; 
            top: -100px; 
            right: 0px; 
            height: 900px; 
            background-color: #F2FBEF; 
            color: #000;
        }

    </style>
</style>
      <title>Reporte de Ventas Por Producto</title>
</head>
<body>

<?php

$suma1 = 0;
$suma2 = 0;

?>

 <!--header para cada pagina-->
    <div id="header">
        <img src="img/logo.png" width=100>
    </div>
    <!--footer para cada pagina-->
    <div id="footer">
        <!--aqui se muestra el numero de la pagina en numeros romanos-->
        <p class="page"></p>
    </div>

<div id="content">
    <table class="letranormal">
        <caption class="letragrande">Ventas por Producto</caption>
        <caption>Al <?=  $date ?></caption>
        <br>
        <br>
        <thead>
          <tr>
            <th>FECHA</th>
            <th>TIPO.DOC.</th>
            <th>NUMERO</th>
            <th>CLIENTE</th>
            <th>ID</th>
            <th>PRODUCTO</th>
            <th>CANT</th>
            <th>PRECIO</th>
            <th>DESCTO</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>

        <?php 
          
         foreach($data as $ventas)
         {  
            ?>
            <tr>
                <td><?= date('d-m-Y',strtotime($ventas->fecha)); ?></td>
                <td><?= $ventas->tipodocumento; ?></td>
                <td><?= $ventas->numero; ?></td>
                <td><?= $ventas->cliente; ?></td>
                <td><?= $ventas->idproducto; ?></td>
                <td><?= $ventas->nombre; ?></td>
                <td><?= $ventas->cantidad; ?></td>
                <td><?= $ventas->preciounitario; ?></td>
                <td><?= $ventas->descuento; ?></td>
                <td><?= ($ventas->cantidad * ($ventas->preciounitario-$ventas->descuento)); ?></td>
            </tr>
            
            <?php

            $suma1   = $suma1 + $ventas->cantidad;
            $suma2   = $suma2 + ($ventas->cantidad*$ventas->preciounitario);

        }   
        
        ?>
            
        </tbody>
        
        <?php
        if ($suma1>0)
        {?>
           <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>     
                <td><strong>TOTALES</td>
                <td><strong><?= $suma1; ?></td>
                <td></td>
                <td></td>
                <td><strong><?= $suma2; ?></td>
            </tr>
        <?php
        }
        ?>
        
      </table>
      
</div>
</body>
</html>