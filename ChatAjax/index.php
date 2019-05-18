<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>CHAT</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link href="https://fonts.googleapis.com/css?family=Mukta+Vaani&display=swap" rel="stylesheet">
	<script type="text/javascript">
		function ajax(){
			var req = new XMLHttpRequest();
			req.onreadystatechange = function(){
				if(req.readyState == 4 && req.status == 200){
					document.getElementById('chat').innerHTML = req.responseText;
				}
			}
			req.open('GET', 'chat.php', true);
			req.send();
		}

		//linea que hace que se refresque cada segundo
		setInterval(function(){
			ajax();
		}, 1000);

	</script>
</head>
<body onload="ajax();">
	<div id="contenedor">
		<div id="caja_chat">
			<div id="chat"> 
			</div>
		</div>
		<form method="POST" action="index.php">
			<input type="text" name="nombre" placeholder="Ingresa tu nombre.">
			<textarea name="mensaje" placeholder="Ingresa tu mensaje."></textarea>
			<input type="submit" name="enviar" value="ENVIAR">
		</form>
		<?php
        	if (isset($_POST['enviar'])) {
        	    	$nombre = $_POST['nombre'];
        	    	$mensaje = $_POST['mensaje'];

        	    	$consulta = "INSERT INTO chat (nombre, mensaje) VALUES('$nombre', '$mensaje')";
        	    	$ejecutar = $conexion->query($consulta);
        	    	if($ejecutar){
        	    		echo "<embed loop = 'false' 'src=sonido/beep.mp3' hidden='true' autoplay='true'>";
        	    	}else{
        	    		echo "NO SE EJECUTA";
        	    	}
        	    }    
		?>
	</div>
</body>
</html>