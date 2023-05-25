<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="../img/carrinho.png">
    <title>Mercado</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid justify-content-center">
            <a class="navbar-brand fs-1" href="#">CRUD Mercado</a>
        </div>
    </nav>

    <div class="container">
        <div class="text-center mt-5">
            <h1>Selecione um Card</h1>
            <div class="row justify-content-center">
                <div class="col-sm-5 mt-5">
                    <div class="card h-100" style="width: 22rem;">
                        <img class="card-img-top" src="../img/carrinho.png" style="height: 350px;">
                        <div class="card-body">
                            <h5 class="card-title">Lista de Compras</h5>
                            <p class="card-text">Contém todas as listas de compras.</p>
                            <a href="../src/listacompras/listacompras.php" class="btn btn-primary">Entrar</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-3 mt-5">
                    <div class="card h-100" style="width: 22rem;">
                        <img class="card-img-top" src="../img/produtos.png" style="height: 350px;">
                        <div class="card-body">
                            <h5 class="card-title">Produtos</h5>
                            <p class="card-text">Contém todos os Produtos.</p>
                            <a href="../src/produtos/produtos.php" class="btn btn-primary">Entrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>