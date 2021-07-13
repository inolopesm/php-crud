<?php

include __DIR__ . "/vendor/autoload.php";

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
  $vaga->excluir();

  header("Location: index.php?status=success");
  exit;
}

include __DIR__ . "/includes/header.php";
include __DIR__ . "/includes/confirmar_exclusao.php";
include __DIR__ . "/includes/footer.php";
