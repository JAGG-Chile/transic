<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte Cuentas Por Cobrar - Por Vencimiento</title>
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
        width: 10%;
        text-align: center;
    }
     
    table td:nth-child(3) {
        width: 10%;
        text-align: center;
    }
    table td:nth-child(4) {
        width: 5%;
        text-align: center;
    }
    table td:nth-child(5) {
        width: 5%;
        text-align: center;
    }
    table td:nth-child(6) {
        width: 30%;
        text-align: left;
    }
     
     table td:nth-child(7) {
        width: 10%;
        text-align: right;
    }
    table td:nth-child(8) {
        width: 5%;
        text-align: center;
    }
    table td:last-child {
        width: 10%;
        text-align: center;
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

      <title>Reporte de Cuentas por Cobrar por Vencimiento</title>
</head>
<body>

<?php

$suma = 0;
$dias30   = (strtotime($date)+30)/86400;
$dias30 = abs($dias30);
$dias30 = floor($dias30);

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
        <caption class="letragrande">Cuentas por Cobrar por Vencimiento</caption>
        <caption>Al <?=  $date ?></caption>
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
                <td><?= $ventas->tipodocumento; ?></td>
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