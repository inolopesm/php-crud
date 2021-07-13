<?php

namespace App\Db;

use \PDO;
use \PDOException;
use \PDOStatement;

class Database {
  /**
   * Host de conexão com o banco de dados
   * @var string
   * */
  const HOST = "localhost";

  /**
   * Nome do banco de dados
   * @var string
   */
  const NAME = "wdev_vagas";

  /**
   * Usuário do banco de dados
   * @var string
   */
  const USER = "wdev_vagas";

  /**
   * Senha de acesso ao banco de dados
   * @var string
   */
  const PASS = "wdev_vagas";

  /**
   * Nome da tabela a ser manipulada
   * @var string|null
   */
  private $table;

  /**
   * Instância de conexão com o banco de dados
   * @var PDO
   */
  private $connection;

  /**
   * Define a tabela e instancia a conexão
   * @param string|null $table
   */
  public function __construct($table = null) {
    $this->table = $table;
    $this->setConnection();
  }

  /**
   * Método responsável por criar uma conexão com o banco de dados
   */
  private function setConnection() {
    try {
      $this->connection = new PDO("mysql:host=" . self::HOST . ";dbname=" . self::NAME, self::USER, self::PASS);
      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $exception) {
      die("Error: " . $exception->getMessage());
    }
  }

  /**
   * Método responsável por executar queries dentro do banco de dados
   * @param string $query
   * @param array $params
   * @return PDOStatement
   */
  public function execute($query, $params = []) {
    try {
      $statement = $this->connection->prepare($query);
      $statement->execute($params);
      return $statement;
    } catch(PDOException $exception) {
      die("Error: " . $exception->getMessage());
    }
  }

  /**
   * Método responsável por inserir dados no banco
   * @param array $values [field => value]
   * @return integer identificador do último item inserido
   */
  public function insert($values) {
    $fields = array_keys($values);
    // $binds = array_pad([], count($fields), "?");
    $binds = array_map(function() { return "?"; }, $fields);
    $query = "insert into " . $this->table . " (" . implode(", ", $fields) . ") values (" . implode(", ", $binds) . ")";
    $this->execute($query, array_values($values));
    return $this->connection->lastInsertId();

  }

  /**
   * Método responsável por executar uma consulta no banco
   * @param string|null $where
   * @param string|null $order
   * @param string|null $limit
   * @param string $fields
   * @return PDOStatement
   */
  public function select($where = null, $order = null, $limit = null, $fields = "*") {
    $where = is_string($where) && strlen($where) ? "where " . $where : "";
    $order = is_string($order) && strlen($order) ? "order by " . $order : "";
    $limit = is_string($limit) && strlen($limit) ? "limit " . $limit : "";
    $query = "select $fields from {$this->table} $where $order $limit";
    return $this->execute($query);
  }

  /**
   * Método responsável por executar atualizações no banco de dados
   * @param string $where
   * @param array $values [field => value]
   * @return boolean
   */
  public function update($where, $values) {
    $fields = array_keys($values);
    $fields = array_map(function($field) { return $field . " = ?"; }, $fields);
    $query = "update " . $this->table . " set " . implode(", ", $fields) . "where " . $where;
    $this->execute($query, array_values($values));
    return true;
  }

  /**
   * Método responsável por excluir dados do banco
   * @param string $where
   * @return boolean
   */
  public function delete($where) {
    $query = "delete from {$this->table} where $where";
    $this->execute($query);
    return true;
  }
}
