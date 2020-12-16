<?php

	require("../../domain/connection.php");
	require("../../domain/automoveis.php");

	class AutomoveisProcess {
		var $cd;

		function doGet($arr){
			$cd = new AutomoveisDAO();
			if($arr["id"] == "0")
				$sucess = $cd->readAll();
			else
				$sucess = $cd->read($arr["id"]);
			//$sucess = "use to result to DAO";
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPost($arr){
			$cd = new AutomoveisDAO();
			if(!empty($arr["placa"])){
				$automovel = new Automovel();
				$automovel->setId($arr["id"]);
				$automovel->setPlaca($arr["placa"]);
				$sucess = $cd->create($automovel);
				if(!isset($sucess["err"])){
					http_response_code(201);
					echo json_encode($sucess);
				}else{			
					echo '{"mensagem":"Falha"}';
				}
			//$sucess = "use to result to DAO";
			}
		}
	

		function doPut($arr){
			$cd = new AutomoveisDAO();
			
			if(!empty($arr["id"])){

				$automovel = new Automovel();
				$automovel->setId($arr["id"]);
				$automovel->setPlaca($arr["placa"]);
				$sucess = $cd->update($automovel);

				if(!isset($sucess["err"])){
					http_response_code(201);
					echo json_encode($sucess);
				}else{			
					echo '{"mensagem":"Falha"}';
				}
			//$sucess = "use to result to DAO";
			}
		}


		function doDelete($arr){
			$cd = new AutomoveisDAO();
			if(!empty($arr["placa"])){
				$sucess = $cd->delete($arr["placa"]);
				if(!isset($sucess["err"])){
					http_response_code(201);
					echo json_encode($sucess);
				}else{			
					echo '{"mensagem":"Falha"}';
				}
			//$sucess = "use to result to DAO";
			}
		}
}