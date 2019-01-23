<?php
	require('conector.php');
	//crear conexion con la clase conector
	$con = new conectorBD();
	$response['conexion'] = $con->initConexion($con->database);
	if ($response['conexion'] == 'OK') {
		if ($con->eliminarRegistro('eventos', 'id='.$_POST['id'])) {
			$response['msg'] = 'OK';
		}else{
			$response['msg'] = 'No se a podido Eliminar el Registro';
		}
	}else{
			$response['msg'] = "error en la Comunicación con la Base de Datos";
		}
	echo json_encode($response)


 ?>
