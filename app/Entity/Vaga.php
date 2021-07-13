<?php

namespace App\Entity;

use \App\Db\Database;
use \PDO;

class Vaga {
  /**
   * Identificador único da vaga
   * @var integer
   */
  public $id;

  /**
   * Título da vaga
   * @var string
   */
  public $titulo;

  /**
   * Descrição da vaga (pode conter html)
   * @var string
   */
  public $descricao;

  /**
   * Define se a vaga está ativa
   * @var string(s/n)
   */
  public $ativo;

  /**
   * Data de publicação da vaga
   * @var string
   */
  public $data;

  /**
   * Método responsável por cadastrar uma nova vaga
   * @return boolean
   */
  public function cadastrar() {
    $this->data = date("Y-m-d H:i:s");
    $database = new Database("vagas");
    $this->id = $database->insert([
      "titulo"    => $this->titulo,
      "descricao" => $this->descricao,
      "ativo"     => $this->ativo,
      "data"      => $this->data
    ]);
    return true;
  }

  /**
   * Método responsável por obter as vagas do banco de dados
   * @param string|null $where
   * @param string|null $order
   * @param string|null $limit
   * @return array
   */
  public static function getVagas($where = null, $order = null, $limit = null) {
    $database = new Database("vagas");
    $statement = $database->select($where, $order, $limit);
    return $statement->fetchAll(PDO::FETCH_CLASS, self::class);
  }

  /**
   * Método responsável por buscar uma vaga com base em seu identificador
   * @param integer $id
   * @return Vaga|false
   */
  public static function getVaga($id) {
    $database = new Database("vagas");
    $statement = $database->select("id = $id");
    return $statement->fetchObject(self::class);
  }

  /**
   * Método responsável por atualizar a vaga no banco de dados
   * @return boolean
   */
  public function atualizar() {
    $database = new Database("vagas");
    $database->update("id = {$this->id}", [
      "titulo"    => $this->titulo,
      "descricao" => $this->descricao,
      "ativo"     => $this->ativo,
      "data"      => $this->data
    ]);
  }

  /**
   * Método responsável por excluir a vaga no banco de dados
   * @return boolean
   */
  public function excluir() {
    $database = new Database("vagas");
    $database->delete("id = {$this->id}");
  }
}
