<?php
	require('conector.php');
	$con = new conectorBD();
	$response['conexion'] = $con->initConexion($con->database);

	if(isset($_SESSION['email'])){
		$response['msg'] = 'OK';
		$response['acceso'] = 'Autorizado';
	}else{
		if ($response['conexion']== 'OK') {
			if($con->verifyUsers() > 0){
				$resultado_consulta = $con->consultar(['usuarios'],['email','password'], 'WHERE email="'.$_POST['username'].'"');
			if ($resultado_consulta->num_rows != 0) {
				$fila = $resultado_consulta->fetch_assoc();
				if (password_verify($_POST['password'],$fila['password'])) {
					$response['msg'] = 'OK';
					$response['acceso'] = 'Autorizado';
					$_SESSION['email'] = $fila['email'];
				}else{
					$response['msg'] = 'Contraseña Incorrecta';
					$response['acceso'] = 'acceso denegado';
					}
				}else{
					$response['msg'] = 'Email Incorrecto';
					$response['acceso'] = 'acceso denegado';
					}
				}else{
					$response['conexion'] = 'No se pudo Inciar la Sesion';
				}
			}
		}
		echo json_encode($response);
	$con->cerrarConexion();

 ?>
