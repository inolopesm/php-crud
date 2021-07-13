<main>
  <section>
    <a class="btn btn-success" href="index.php">Voltar</a>
  </section>
  <h2 class="mt-3">Excluir vaga</h2>
  <form method="POST">
    <div class="mb-3">
      <p>Você deseja realmente excluir a vaga <strong><?= $vaga->titulo ?></strong>?</p>
    <div class="mb-3">
      <a class="btn btn-secondary" href="index.php">Cancelar</a>
      <button class="btn btn-danger" type="submit">Excluir</button>
    </div>
  </form>
</main>
