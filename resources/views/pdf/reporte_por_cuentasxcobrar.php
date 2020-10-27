<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte Deuda por Cliente</title>
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
            width: 5%;
            text-align: left;
        }
        table td:nth-child(3) {
            width: 5%;
            text-align: left;
        }
        table td:nth-child(4) {
            width: 20%;
            text-align: center;
        }
        table td:nth-child(5) {
            width: 5%;
            text-align: right;
        }
        table td:nth-child(6) {
            width: 30%;
            text-align: center;
        }
        table td:nth-child(7) {
            width: 5%;
            text-align: left;
        }
        table td:nth-child(8) {
            width: 10%;
            text-align: left;
        }
        table td:nth-child(9) {
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
    <p class="letragrande">Deuda por Cliente</p>
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
        <caption>Desde: <?= date('d-m-Y',strtotime($desde));?>   Hasta: <?= date('d-m-Y',strtotime($hasta));?></caption>
        <br>
        <br>
        <thead>
          <tr>
            <th>VENCIMIENTO</th>
            <th>EMISION</th>
            <th>CRED.</th>
            <th>TIPO.DOC</th>
            <th>NUMERO</th>
            <th>CLIENTE</th>
            <th>MONTO</th>
            <th>MORA</th>
            <th>DT-FE</th>
          </tr>
        </thead>
        <tbody>

        <?php 
          
         foreach($data as $ventas)
         { 

            $cred   = (strtotime($ventas->vencimiento)-strtotime($ventas->fecha))/86400;
            $cred   = abs($cred); $cred = floor($cred);   
            $mora   = (strtotime($date)-strtotime($ventas->vencimiento))/86400;  
            $mora   = abs($mora); $mora = floor($mora);   
            ?>

            <tr>
                <td><?= date('d-m-Y',strtotime($ventas->vencimiento)); ?></td>
                <td><?= date('d-m-Y',strtotime($ventas->fecha)); ?></td>
                <td><?= $cred;?></td>
                <td><?= $ventas->tipodocumento;?></td>
                <td><?= $ventas->numero; ?></td>
                <td><?= $ventas->nombre; ?></td>
                <td><?= $ventas->totalventa; ?></td>
                <td><?= $mora; ?></td>
                <td><?= $cred-$mora; ?></td>
            </tr>
            
            <?php

            $suma   = $suma + $ventas->totalventa;

        }   
        
        ?>
            
        </tbody>
        
        <?php
       
        if ($suma>0)
        {?>
           <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>     
                <td><strong>TOTAL</td>
                <td><strong><?= $suma; ?></td>
                <td></td>
                <td></td>
            </tr>
        <?php
        }
        ?>
        
      </table>
      
</div>
</body>
</html>