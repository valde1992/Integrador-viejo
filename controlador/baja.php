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

		if($action == 'baja')
		{
			$res = delete();
		}
		else
		{
			header ('Location: ../index.php?error=1');
			die();
		}
	}	

	if($res == 'ok'){
		session_destroy();
		header ('Location: ../index.php');
	}
	else
	{
		header ('Location: ../index.php?error=1');
		die();
	}

	function delete(){
		include "../modelo/usuario.class.php";

		$a = new Usuario();

		try {

			$res = $a->baja($_SESSION['id']);

		} catch (Exception $e) {
			header("Location: ../vista/error/ErrorModify.php?msg".$e->getMessage());
			die();
		}

		if($res == 'ok')
		{
			return $res;
			header ('Location: ../vista/personal/Baja_ok.php');
			die();
		}
		elseif ($res == 'fail') 
		{
			header ('Location: ../index.php?error=1');
			die();
		}
	}
