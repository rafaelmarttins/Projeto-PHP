<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
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
                <h1>Listas de Compras</h1>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col text-start">
                    <button class="btn btn-success mb-3" data-bs-toggle="modal"
                        data-bs-target="#registrarModal">Registrar Lista</button>
                </div>
                <div class="col text-end">
                    <a href="../../src/index.php" class="btn btn-primary mb-3">Voltar</a>
                </div>
            </div>
        </div>

        <!-- Modal para registrar uma lista nova -->
        <div class="modal fade" id="registrarModal" tabindex="-1" aria-labelledby="registrarModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registrarModalLabel">Registrar Lista</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="criar_lista.php">
                            <div class="mb-3">
                                <label for="nomelista" class="form-label">Nome da lista</label>
                                <input type="text" class="form-control" id="nomelista" name="nomelista" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para editar a lista -->
        <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center" id="editarModalLabel">Editar Lista</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editarForm" method="post" action="editar_lista.php">
                            <input type="hidden" name="id" id="editarId">
                            <div class="mb-3">
                                <label for="editarNomeLista" class="form-label">Insira o novo nome da Lista</label>
                                <input type="text" class="form-control" id="editarNomeLista" name="nomelista" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para adicionar produtos à lista -->
        <div class="modal fade" id="adicionarModal" tabindex="-1" aria-labelledby="adicionarModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="adicionarModalLabel">Adicionar Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="adicionarForm" action="adicionar_produto.php" method="POST">
                            <input type="hidden" id="codigolista" name="codigolista" value="">
                            <div class="mb-3">
                                <label for="produtoSelect" class="form-label">Selecione o Produto:</label>
                                <select class="form-select" id="produtoSelect" name="produtoSelect">
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="quantidadeProduto" class="form-label">Quantidade:</label>
                                <input type="number" class="form-control" id="quantidadeProduto"
                                    name="quantidadeProduto" min="1" value="1">
                            </div>
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mensagens -->
        <?php if (isset($_GET['mensagem']) && $_GET['mensagem'] !== '') : ?>
        <?php if ($_GET['mensagem'] === "A descrição do produto já existe. Por favor, insira uma descrição diferente.") : ?>
        <div class="modal fade" id="mensagemModal" tabindex="-1" aria-labelledby="mensagemModalLabel"
            aria-hidden="true">
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
        <div class="modal fade" id="mensagemModal" tabindex="-1" aria-labelledby="mensagemModalLabel"
            aria-hidden="true">
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

        <!-- Modal Detalhes Produto -->
        <div class="modal fade" id="detalhesModal" tabindex="-1" aria-labelledby="detalhesModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detalhesModalLabel">Detalhes da Lista</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6>Produtos na Lista:</h6>
                        <ul id="listaProdutos"></ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">Nome da Lista</th>
                            <th scope="col">Adicionar Produto na Lista</th>
                            <th scope="col">Detalhes da lista</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $conn = new mysqli("localhost", "root", "", "mercado");

                        if ($conn->connect_error) {
                            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
                        }

                        $sql = "SELECT CodigoLista, NomeLista FROM listacompras ORDER BY CodigoLista";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["NomeLista"] . "</td>";
                                echo "<td><button class='btn btn-secondary btn-adicionar' data-id='" . $row["CodigoLista"] . "'>Adicionar</button></td>";
                                echo "<td><button class='btn btn-primary btn-detalhes' data-id='" . $row["CodigoLista"] . "'>Detalhes</button></td>";
                                echo "<td>";
                                echo "<button class='btn btn-warning btn-editar' data-id='" . $row["CodigoLista"] . "' data-nome='" . $row["NomeLista"] . "' style='margin-right: 30px;'>Editar</button>";
                                echo "<a class='btn btn-danger' href='delete_lista.php?id=" . $row["CodigoLista"] . "'>Excluir</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Nenhuma lista de compras encontrada.</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabela para exibir os produtos adicionados -->
        <table class="table table-striped table-bordered text-center" id="tabelaProdutos" class="table">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

        <!-- Botão para enviar os produtos -->
        <div class="d-flex justify-content-center">
            <button id="btnEnviarProdutos" class="btn btn-primary">Adicionar Produto na Lista</button>
        </div>


        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>

        <script src="../../js/script.js"></script>
</body>

</html>