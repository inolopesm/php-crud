<?php

include __DIR__ . "/vendor/autoload.php";

define("TITLE", "Editar Vaga");

use \App\Entity\Vaga;

if (!array_key_exists("id", $_GET) || !ctype_digit($_GET["id"])) {
  header("Location: index.php?status=error");
  exit;
}

$id = intval($_GET["id"]);

$vaga = Vaga::getVaga($id);

if ($vaga === false) {
  header("Location: index.php?status=error");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  foreach(["titulo", "descricao", "ativo"] as $key) {
    if(!array_key_exists($key, $_POST)) {
      die("Não editar");
    }
  }

  $vaga->titulo = $_POST["titulo"];
  $vaga->descricao = $_POST["descricao"];
  $vaga->ativo = $_POST["ativo"];

  $vaga->atualizar();
  header("Location: index.php?status=success");
  exit;
}

include __DIR__ . "/includes/header.php";
include __DIR__ . "/includes/formulario.php";
include __DIR__ . "/includes/footer.php";
