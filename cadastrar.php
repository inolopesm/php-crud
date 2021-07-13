<?php

include __DIR__ . "/vendor/autoload.php";

define("TITLE", "Cadastrar Vaga");

use \App\Entity\Vaga;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  foreach(["titulo", "descricao", "ativo"] as $key) {
    if(!array_key_exists($key, $_POST)) {
      die("Não cadastrar");
    }
  }

  $vaga = new Vaga();
  $vaga->titulo = $_POST["titulo"];
  $vaga->descricao = $_POST["descricao"];
  $vaga->ativo = $_POST["ativo"];

  $vaga->cadastrar();

  header("Location: index.php?status=success");
  exit;
}

include __DIR__ . "/includes/header.php";
include __DIR__ . "/includes/formulario.php";
include __DIR__ . "/includes/footer.php";
