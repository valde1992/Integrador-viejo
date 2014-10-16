<?php

session_start();

	if (isset($_SESSION['nombre'])) 
	{
		header("Location: ../vista/personal/AreaPersonal.php");
	}

	if($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['action']))
	{
		header("Location: ../index.php");
	}	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['action']))
	{
		header("Location: ../index.php");
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$action = $_POST['action'];

		if($action == 'modificar')
		{
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$user = $_POST['user'];
			$pass = $_POST['pass'];

			$res = modificar($usuario,$_SESSION['id']);

			return $res;
		}
		else
		{
			header ('Location: ../index.php?error=1');
			die();
		}
	}	

	function modify(){
		include "../modelo/usuario.class.php";

		$a = new Usuario();

		try {

			$res = $a->obtener($_SESSION['id']);

		} catch (Exception $e) {
			header("Location: ../vista/error/ErrorModify.php?msg".$e->getMessage());
			die();
		}

		if($res == 'ok')
		{
			header ('Location: ../vista/personal/Modificacion_ok.php');
			die();
		}
		elseif ($res == 'fail') 
		{
			header ('Location: ../index.php?error=1');
			die();
		}
	}


	