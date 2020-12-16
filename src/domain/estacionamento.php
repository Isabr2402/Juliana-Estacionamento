<?php

	class Estacionar {
		var $id_auto;
		var $ent;
		var $sai;
		var $custo;
		var $id;

		function getId_auto(){
			return $this->id_auto;
		}
		function setId_auto($id_auto){
			$this->id_auto = $id_auto;
		}
		function getEnt(){
			return $this->ent;
		}
		function setEnt($ent){
			$this->ent = $ent;
		}
		function getSai(){
			return $this->sai;
		}
		function setSai($sai){
			$this->sai = $sai;
		}
		function getCusto(){
			return $this->custo;
		}
		function setCusto($custo){
			$this->custo = $custo;
		}

	}

	class EstacionamentoDAO {
		
		function create($estacionamento) {
			$result = array();

			$ent = $estacionamento->getEnt();
			$sai = $estacionamento->getSai();
			$custo = $estacionamento->getCusto();
			$id_auto = $estacionamento->getId_auto();

			$query = "INSERT INTO estacionamento VALUES ('$id_auto','$ent','$sai','$custo',default)";

			try {

				$con = new Connection();
				if(Connection::getInstance()->exec($query) >= 1){
					$result["id_auto"] = $id_auto;
					$result["ent"] = $ent;
					$result["sai"] = $sai;
					$result["custo"] = $custo;
				}else{
					$result["err"] = "Erro";
				}
				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function readAll() {

			$result = array();
			$query = "SELECT * FROM estacionamento";

			try {
				
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);

				while($linha = $resultSet->fetchObject()){
					$estacionar = new Estacionar();
					$estacionar->setId_auto($linha->id_auto);
					$estacionar->setEnt($linha->ent);
					$estacionar->setSai($linha->sai);
					$estacionar->setCusto($linha->custo);
					$estacionamento[] = $estacionar;

				}

				$result = $estacionamento;
				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function read($id_auto) {

			$result = array();
			$query = "SELECT * FROM estacionamento WHERE id_auto = $id_auto";

			try {
				
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);

				while($linha = $resultSet->fetchObject()){
					$estacionar = new Estacionar();
					$estacionar->setId_auto($linha->id_auto);
					$estacionar->setEnt($linha->ent);
					$estacionar->setSai($linha->sai);
					$estacionar->setCusto($linha->custo);
					$estacionamento[] = $estacionar;

				}

				$result = $estacionamento;
				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}
		
		function update($estacionamento) {

			$result = array();
			$query = "UPDATE estacionamento SET ent = '".$estacionamento->getEnt()."', sai = '".$estacionamento->getSai()."', 
			custo = '".$estacionamento->getCusto()."' WHERE id_auto = ".$estacionamento->getId_auto();

			try {

				$con = new Connection();
				$status = Connection::getInstance()->prepare($query);

				if($status->execute()){
					$result[] = $estacionamento;
				}else{
					$result["err"] = "Não foi possível alterar";
				}

				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function delete($id_auto) {

			$result = array();
			$query = "DELETE FROM estacionamento WHERE id_auto = '$id_auto'";

			try {
			
				$con = new Connection();
				if(Connection::getInstance()->exec($query) >= 1){
					$result["mensagem"] = "Deletado com sucesso.";
				} else {
					$result["erro"] = "Não foi possível deletar.";
				}
				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}
	}