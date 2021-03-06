<?php

include __DIR__ . "/vendor/autoload.php";

use \App\Entity\Vaga;
use \App\Db\Pagination;

$busca = filter_input(INPUT_GET, "busca", FILTER_SANITIZE_STRING);
$status = filter_input(INPUT_GET, "status", FILTER_SANITIZE_STRING);
$status = in_array($status, ["s", "n"]) ? $status : "";

// $condicoes = [];
// if (strlen($busca)) $condicoes[] = "titulo LIKE '%" . str_replace(" ", "%", $busca) . "%'";
// if (strlen($status)) $condicoes[] = "status = $status";

$condicoes = [
  strlen($busca) ? "titulo LIKE '%" . str_replace(" ", "%", $busca) . "%'" : null,
  strlen($status) ? "ativo = '$status'" : null
];

$condicoes = array_filter($condicoes);

$where = implode(" and ", $condicoes);

$quantidadeVagas = Vaga::getQuantidadeVagas($where);

$pagination = new Pagination($quantidadeVagas, $_GET["pagina"] ?? 1, 10);

$vagas = Vaga::getVagas($where, null, $pagination->getLimit());

include __DIR__ . "/includes/header.php";
include __DIR__ . "/includes/listagem.php";
include __DIR__ . "/includes/footer.php";
