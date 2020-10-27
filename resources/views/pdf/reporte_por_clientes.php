<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Reporte de Clientes</title>
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
        width: 30%;
        text-align: left;
    }
     
    table td:nth-child(2) {
        width: 10%;
        text-align: left;
    }
     
    table td:nth-child(3) {
        width: 20%;
        text-align: left;
    }
    table td:nth-child(4) {
        width: 10%;
        text-align: left;
    }
    
    table td:last-child {
        width: 30%;
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

</head>
<body>

<?php

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
        <caption class="letragrande">Listado de Clientes</caption>
        <caption>Al <?=  $date ?></caption>
        <br>
        <br>
        <thead>
          <tr>
            <th>NOMBRE</th>
            <th>RUT</th>
            <th>CONTACTO</th>
            <th>TELEFONO</th>
            <th>EMAIL</th>
          </tr>
        </thead>
        <tbody>

        <?php 
          
        foreach($data as $cliente)
        {   
           ?>     
            <tr>
                <td><?= $cliente->nombre; ?></td>
                <td><?= $cliente->rut; ?></td>
                <td><?= $cliente->contacto; ?></td>
                <td><?= $cliente->telefono; ?></td>
                <td><?= $cliente->email; ?></td>
            </tr>
            
            <?php

        }   
        
        ?>
            
        </tbody>
        
        
      </table>
      
</div>
</body>
</html>