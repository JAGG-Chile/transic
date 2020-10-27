<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte Ventas Por Cliente</title>
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
            width: 10%;
            text-align: center;
        }
        table td:nth-child(3) {
            width: 30%;
            text-align: center;
        }
        table td:nth-child(4) {
            width: 30%;
            text-align: center;
        }
        table td:nth-child(5) {
            width: 10%;
            text-align: center;
        }
         table td:nth-child(6) {
            width: 10%;
            text-align: center;
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
    <p class="letragrande">Cuenta Corriente por Producto</p>
</div>

<!--footer para cada pagina-->
<div id="footer">
    <!--aqui se muestra el numero de la pagina en numeros romanos-->
    <p class="page"></p>
</div>

<?php

$suma = 0;

?>

<div>
    <table>
        <!--<caption>Ventas por Cliente</caption>-->
        <caption>Desde: <?= date('d-m-Y',strtotime($desde));?>   Hasta: <?= date('d-m-Y',strtotime($hasta));?></caption>
        <br>
        <br>
        <thead>
            <tr>
                <th>Fecha</th>
			    <th>Docto</th>
			    <th>Proveedor / Cliente</th>
			    <th>Producto</th>
			    <th>Ingreso</th>
			    <th>Egreso</th>
            </tr>
		</thead>
		
        <tbody>

        <?php 
        	$ingresos=0;
			$egresos=0;
		          
         foreach($data as $v)
         {  
            ?>
                        
            	<tr>
					<td><?=date('d-m-Y',strtotime($v->fecha));?></td>
					<td><?=substr($v->documento,1); ?></td>
					<td><?=$v->nombre; ?></td>
					<td><?=$v->prod; ?></td>
					
					<?php
					
					$tipo = $v->documento;
					
					if (substr($tipo,0,1)=="C")
						{?>
							<td><?=$v->cantidad; ?></td>
							<td></td>
							<?php
								$ingresos=$ingresos+$v->cantidad;
						}
					else
						{?>
							<td></td>
							<td><?=$v->cantidad;?></td>
							<?php
								$egresos=$egresos+$v->cantidad;
						}?>
				</tr>
        <?php  
        }   
        ?>    
		</tbody>
	</table>
</div>
</body>
</html>