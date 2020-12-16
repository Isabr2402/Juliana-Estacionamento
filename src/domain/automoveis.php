<?php

	class Automovel {
		var $id;
		var $placa;

		function getId(){
			return $this->id;
		}
		function setId($id){
			$this->id = $id;
		}

		function getPlaca(){
			return $this->placa;
		}
		function setPlaca($placa){
			$this->placa = $placa;
		}
	}

	class AutomoveisDAO {

		function create($automoveis) {

			$result = array();
			$placa = $automoveis->getPlaca();
			$query = "INSERT INTO automoveis VALUES (default, '$placa') ";
			
			try {

				$con = new Connection();
				if(Connection::getInstance()->exec($query) >= 1){
					$result["id"] = Connection::getInstance()->lastInsertId();
					$result["placa"] = $placa;
				}else{
					$result["err"] = "Erro";
				}
				$con = null;
				
			}catch(PDOException $e) {
				$result["err"] = "meh";
			}

			return $result;
		}

		function readAll() {

			$automoveis = [];
			$result = array();
			$query = "SELECT * FROM automoveis";

			try {
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);

				while($linha = $resultSet->fetchObject()){
					$automovel = new Automovel();
					$automovel->setId($linha->id);
					$automovel->setPlaca($linha->placa);
					$automoveis[] = $automovel;
				}

				$result = $automoveis;
				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function read($id) {

			$automoveis = [];
			$result = array();
			$query = "SELECT * FROM automoveis WHERE id = $id";

			try {
				$con = new Connection();
				$resultSet = Connection::getInstance()->query($query);

				while($linha = $resultSet->fetchObject()){
					$automovel = new Automovel();
					$automovel->setId($linha->id);
					$automovel->setPlaca($linha->placa);
					$automoveis[] = $automovel;
				}

				$result = $automoveis;
				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}		

		function update($automoveis) {

			$result = array();
			$query = "UPDATE automoveis SET placa = '".$automoveis->getPlaca()."' WHERE id = ".$automoveis->getId();

			try {
				
				$con = new Connection();
				$status = Connection::getInstance()->prepare($query);

				if($status->execute()){
					$result[] = $automoveis;
				}else{
					$result["err"] = "Não foi possível alterar";
				}
				$con = null;
			}catch(PDOException $e) {
				$result["err"] = $e->getMessage();
			}

			return $result;
		}

		function delete($placa) {

			$result = array();
			$query = "DELETE FROM automoveis WHERE  placa = '$placa'";

			try {
				
				$con = new Connection();
				if(Connection::getInstance()->exec($query)>=1){
					$result["mensagem"] = "Deletado com sucesso.";
				} else {
					$result["erro"] = "Não foi possível deletar.";
				}
				$con = null;
			}catch(PDOException $e){
				$result["erro"] = "Erro de conexão com o BD";	
			}
			return $result;
		}

	}