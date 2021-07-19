<main>
  <section>
    <a class="btn btn-success" href="index.php">Voltar</a>
  </section>
  <h2 class="mt-3"><?= TITLE ?></h2>
  <form method="POST">
    <div class="mb-3">
      <label>Título</label>
      <input class="form-control" name="titulo" value="<?= isset($vaga) ? $vaga->titulo : "" ?>" />
    </div>
    <div class="mb-3">
      <label>Descrição</label>
      <textarea class="form-control" name="descricao" rows="5"><?= isset($vaga) ? $vaga->descricao : "" ?></textarea>
    </div>
    <div class="mb-3">
      <label>Status</label>
      <div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="ativo" value="s" required <?= isset($vaga) ? ($vaga->ativo == "s" ? "checked" : "") : "" ?> />
          <label class="form-check-label">Ativo</label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="ativo" value="n" required <?= isset($vaga) ? ($vaga->ativo == "n" ? "checked" : "") : "" ?> />
          <label class="form-check-label">Inativo</label>
        </div>
      </div>
    </div>
    <div class="mb-3">
      <button class="btn btn-success" type="submit">Enviar</button>
    </div>
  </form>
</main>
