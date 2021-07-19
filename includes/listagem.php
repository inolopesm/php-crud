<main>
  <?php if(array_key_exists("status", $_GET)) { ?>
    <?php if($_GET["status"] == "success") { ?>
      <div class="alert alert-success">
        Ação executada com sucesso!
      </div>
    <?php } ?>
    <?php if($_GET["status"] == "error") { ?>
      <div class="alert alert-danger">
        Ação não executada!
      </div>
    <?php } ?>
  <?php } ?>
  <section>
    <a class="btn btn-success" href="cadastrar.php">Nova vaga</a>
  </section>
  <section>
    <form method="GET">
      <div class="row my-4">
        <div class="col">
          <label>Buscar por título</label>
          <input type="text" name="busca" class="form-control" value="<?= $busca ?>">
        </div>
        <div class="col">
          <label>Status</label>
          <select name="status" class="form-control">
            <option value="">Ativa/Inativa</option>
            <option value="s" <?= $status === "s" ? "selected" : "" ?>>Ativa</option>
            <option value="n" <?= $status === "n" ? "selected" : "" ?>>Inativa</option>
          </select>
        </div>
        <div class="col d-flex align-items-end">
          <button type="submit" class="btn btn-primary">
            Filtrar
          </button>
        </div>
      </div>
    </form>
  </section>
  <section>
    <?php if (count($vagas) > 0) { ?>
      <table class="table bg-light mt-3">
        <thead>
          <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Data</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($vagas as $vaga) { ?>
            <tr>
              <td><?= $vaga->id ?></td>
              <td><?= $vaga->titulo ?></td>
              <td><?= $vaga->descricao ?></td>
              <td><?= $vaga->ativo == "s" ? "Ativo" : "Inativo" ?></td>
              <td><?= date("d/m/Y à\s H:i:s", strtotime($vaga->data)) ?></td>
              <td>
                <a href="editar.php?id=<?= $vaga->id ?>" class="btn btn-primary">Editar</a>
                <a href="excluir.php?id=<?= $vaga->id ?>" class="btn btn-danger">Excluir</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else { ?>
      <p class="text-center">Nenhuma vaga encontrada</p>
    <?php } ?>
  </section>
</main>
