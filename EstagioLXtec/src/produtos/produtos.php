<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <title>Mercado</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid justify-content-center">
            <a class="navbar-brand fs-1" href="#">CRUD Mercado</a>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col text-center mt-5">
                <h1>Produtos</h1>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col text-start">
                    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#registrarModal">Registrar Produto</button>
                </div>
                <div class="col text-end">
                    <a href="../../src/index.php" class="btn btn-primary mb-3">Voltar</a>
                </div>
            </div>
        </div>

        <!-- Modal para registrar produto -->
        <div class="modal fade" id="registrarModal" tabindex="-1" aria-labelledby="registrarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registrarModalLabel">Registrar Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="criar_produto.php">
                            <div class="mb-3">
                                <label for="descricao" class="form-label">Descrição do Produto</label>
                                <input type="text" class="form-control" id="descricao" name="descricao" required>
                            </div>
                            <div class="mb-3">
                                <label for="quantidade" class="form-label">Quantidade</label>
                                <input type="number" class="form-control" id="quantidade" name="quantidade" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal para editar produto -->
        <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarModalLabel">Editar Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editarForm" method="post" action="editar_produto.php">
                            <input type="hidden" name="id" id="editarId">
                            <div class="mb-3">
                                <label for="editarDescricao" class="form-label">Nova Descrição do Produto</label>
                                <input type="text" class="form-control" id="editarDescricao" name="descricao" required>
                            </div>
                            <div class="mb-3">
                                <label for="editarQuantidade" class="form-label">Nova Quantidade do Produto</label>
                                <input type="number" class="form-control" id="editarQuantidade" name="quantidade" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Mensagens -->
        <?php if (isset($_GET['mensagem']) && $_GET['mensagem'] !== '') : ?>
            <?php if ($_GET['mensagem'] === "A descrição do produto já existe. Por favor, insira uma descrição diferente.") : ?>
                <div class="modal fade" id="mensagemModal" tabindex="-1" aria-labelledby="mensagemModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mensagemModalLabel">Mensagem</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php echo $_GET['mensagem']; ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var mensagemModal = new bootstrap.Modal(document.getElementById('mensagemModal'));
                        mensagemModal.show();
                    });
                </script>
            <?php else : ?>
                <div class="modal fade" id="mensagemModal" tabindex="-1" aria-labelledby="mensagemModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="mensagemModalLabel">Mensagem</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <?php echo $_GET['mensagem']; ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var mensagemModal = new bootstrap.Modal(document.getElementById('mensagemModal'));
                        mensagemModal.show();
                        var url = new URL(window.location.href);
                        url.searchParams.delete('mensagem');
                        window.history.replaceState({}, document.title, url);
                    });
                </script>
            <?php endif; ?>
        <?php endif; ?>

        <div class="row">
            <div class="col">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">Código do Produto</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conn = new mysqli("localhost", "root", "", "mercado");

                        if ($conn->connect_error) {
                            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
                        }

                        // Consulta SQL para buscar os produtos no banco de dados
                        $sql = "SELECT CodigoProduto, Descricao, Quantidade FROM produto ORDER BY CodigoProduto";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["CodigoProduto"] . "</td>";
                                echo "<td>" . $row["Descricao"] . "</td>";
                                echo "<td>" . $row["Quantidade"] . "</td>";
                                echo "<td>";
                                echo "<button class='btn btn-primary btn-editar' data-id='" . $row["CodigoProduto"] . "' style='margin-right: 30px;'>Editar</button>";
                                echo "<a class='btn btn-danger' href='delete_produto.php?id=" . $row["CodigoProduto"] . "'>Excluir</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Nenhum produto encontrado.</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>

        <script src="../../js/script.js"></script>
</body>

</html>