<?php

	require("../../domain/connection.php");
	require("../../domain/estacionamento.php");

	class EstacionamentoProcess {
		var $cd;

		function doGet($arr){
			$cd = new EstacionamentoDAO();
			if($arr["id_auto"]==0)
				$sucess = $cd->readAll();
			else
				$sucess = $cd->read($arr["id_auto"]);
			//$sucess = "use to result to DAO";
			http_response_code(200);
			echo json_encode($sucess);
		}


		function doPost($arr){
			$cd = new EstacionamentoDAO();
			if(!empty($arr["id_auto"])){
				$estacionar = new Estacionar();
				$estacionar->setId_auto($arr["id_auto"]);
				$estacionar->setEnt($arr["ent"]);
				$estacionar->setSai($arr["sai"]);
				$estacionar->setCusto($arr["custo"]);
				$sucess = $cd->create($estacionar);
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
			$cd = new EstacionamentoDAO();
			
			if(!empty($arr["id_auto"])){

				$estacionar = new Estacionar();
				$estacionar->setId_auto($arr["id_auto"]);
				$estacionar->setEnt($arr["ent"]);
				$estacionar->setSai($arr["sai"]);
				$estacionar->setCusto($arr["custo"]);
				$sucess = $cd->update($estacionar);

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
			$cd = new EstacionamentoDAO();
			if(!empty($arr["id_auto"])){
				$sucess = $cd->delete($arr["id_auto"]);
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