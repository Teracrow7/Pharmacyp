<!DOCTYPE html>
<html>
<head >
	<title>Login</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/css/all.min.css">
</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="contenedor">
		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="contenido-login">
			<form action="controller/LoginController.php" method="post">
				<img src="img/logo.png">
				<h2>Farmacia "Tecsilla" </h2>
				<div class="input-div dni">
				<div class="i">
					<i class="fas fa-user"></i>			
				</div>
				<div class="div">
					<h5>Usuario</h5>
					<input type="text" name="user" class="in33put">
				</div>	
				</div>
				<div class="input-div pass">
					<div class="i">
					<i class="fas fa-lock"></i>			
				</div>
				<div class="div">
					<h5>Contraseña</h5>
					<input type="password" name="pass" class="input">
				</div>
				</div>

				<input type="submit" class="btn" value="iniciar sesion">
			</form>		
		</div>
	</div>
</body>
<script src="js/login.js"></script>
</html>