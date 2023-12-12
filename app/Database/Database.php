<?php

namespace App\Database;

use App\Configs\Config;

const HOSTNAME = Config::HOSTNAME;
const PORT     = Config::PORT;
const DBNAME   = Config::DBNAME;
const USERNAME = Config::USERNAME;
const PASSWORD = Config::PASSWORD;

const MAX_INIT_ROWS = Config::MAX_INIT_ROWS;

use \PDO as PDO;

/**
 * The class responsable for interaction with DB
 * @author Abdelhaq EL AMRAOUI
 */
class Database
{

  private PDO $conn;


  function __construct()
  {
    $this->connect();
    $this->init();
  }


  function __destruct()
  {
    $this->disconnect();
  }


  function init()
  {
    $sql = <<<TXT
    USE ofppt_api;

    CREATE TABLE IF NOT EXISTS todos (
      id INT unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
      userId int unsigned not null,
      title VARCHAR(255) NOT NULL,
      completed boolean not null
    );
    TXT;



    if (!$this->isConnected()) $this->connect();

    if ($this->isConnected()) {

      if ($this->execute('describe ofppt_api.todos')) {
        return;
      }

      $this->execute($sql);

      $this->execute('truncate todos');

      for ($i = 1; $i <= MAX_INIT_ROWS; $i++) {

        $userId = rand(1, 10);
        $title = "Todo-$i";
        $completed = rand(0, 1);

        $this->execute(
          "insert into todos (userId, title, completed) values(?,?,?)",
          [$userId, $title, $completed]
        );
      }
    }
  }


  private function connect()
  {
    $dsn = sprintf("mysql: host=%s; port=%d; dbname=%s", HOSTNAME, PORT, DBNAME);
    $this->conn = new PDO($dsn, USERNAME, PASSWORD);
  }


  function isConnected(): bool
  {
    return !is_null($this->conn);
  }


  function disconnect()
  {
    unset($this->conn);
  }


  function execute(string $sql, ?array $params = null): bool
  {
    $stmt = $this->conn->prepare($sql);
    return $stmt->execute($params);
  }


  function query(string $sql, ?array $params = null, int $mode = \PDO::FETCH_ASSOC, ?string $class = null): array | false
  {
    $stmt = $this->conn->prepare($sql);
    $stmt->execute($params);
    $res = ($class === null) ? $stmt->fetchAll($mode) : $stmt->fetchAll($mode, $class);
    $stmt->closeCursor();
    return $res;
  }
}
