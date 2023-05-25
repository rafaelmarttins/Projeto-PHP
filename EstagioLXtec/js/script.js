function openEditarModal(id, descricao, quantidade) {
    document.getElementById('editarId').value = id;
    document.getElementById('editarDescricao').value = descricao;
    document.getElementById('editarQuantidade').value = quantidade;
    var editarModal = new bootstrap.Modal(document.getElementById('editarModal'));
    editarModal.show();
}

var btnEditores = document.getElementsByClassName('btn-editar');
for (var i = 0; i < btnEditores.length; i++) {
    btnEditores[i].addEventListener('click', function() {
        var id = this.getAttribute('data-id');
        var descricao = this.parentNode.previousElementSibling.previousElementSibling.innerHTML;
        var quantidade = this.parentNode.previousElementSibling.innerHTML;
        openEditarModal(id, descricao, quantidade);
    });
}

function openEditarModalLista(id, nomeLista) {
    document.getElementById('editarId').value = id;
    document.getElementById('editarNomeLista').value = nomeLista;
    var editarModal = new bootstrap.Modal(document.getElementById('editarModal'));
    editarModal.show();
}

var btnEditores = document.getElementsByClassName('btn-editar');
for (var i = 0; i < btnEditores.length; i++) {
    btnEditores[i].addEventListener('click', function() {
        var id = this.getAttribute('data-id');
        var nomeLista = this.getAttribute('data-nome');
        openEditarModalLista(id, nomeLista);
    });
}

$(document).ready(function() {

    var listaId;

    $('.btn-adicionar').click(function() {
        listaId = $(this).data('id');
        carregarProdutos(listaId);
        $('#adicionarModal').modal('show');
    });


    function carregarProdutos(listaId) {
        $('#codigolista').val(listaId);
        $('#produtoSelect').empty();
    
        $.ajax({
            url: 'carregar_produtos.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $.each(data, function(index, produto) {
                    $('#produtoSelect').append($('<option></option>').val(produto.CodigoProduto).text(produto.Descricao));
                  });

                var produtoSelecionado = $('#produtoSelect option:selected').val();
                exibirQuantidadeProduto(produtoSelecionado, data);

                $('#produtoSelect').change(function() {
                    var produtoSelecionado = $(this).val();
                    exibirQuantidadeProduto(produtoSelecionado, data);
                });
            },
            error: function() {
                alert('Erro ao carregar os produtos.');
            }
        });
    }


    $('#adicionarForm').submit(function(event) {
        event.preventDefault(); // Impede o envio do formulário padrão

        var produtoSelecionado = $('#produtoSelect').val();
        var quantidadeProduto = $('#quantidadeProduto').val();

        if (produtoSelecionado && quantidadeProduto) {
            adicionarProdutoTabela(produtoSelecionado, quantidadeProduto);
            limparCamposFormulario();

            $('#adicionarModal').modal('hide');
        }
    });

    function adicionarProdutoTabela(produtoSelecionado, quantidadeProduto) {

        var descricaoProduto = $('#produtoSelect option:selected').text();
        var codigoProduto = $('#produtoSelect option:selected').val();

        var newRow = $('<tr>');
        newRow.append('<td data-id="' + codigoProduto + '">' + descricaoProduto + '</td>');
        newRow.append('<td>' + quantidadeProduto + '</td>');
        newRow.append('<td><button type="button" class="btn btn-danger btn-remover">Remover</button></td>');


        $('#tabelaProdutos tbody').append(newRow);

        // Define a ação de remover produto ao botão "Remover"
        $('.btn-remover').click(function() {
            $(this).closest('tr').remove();
        });
    }

    function limparCamposFormulario() {
        $('#produtoSelect').val('');
        $('#quantidadeProduto').val('1');
    }

    $('#btnEnviarProdutos').click(function() {
        enviarProdutos(listaId); 
    });

    function enviarProdutos(listaId) {
        var produtos = [];
    
        $('#tabelaProdutos tbody tr').each(function() {
            var produto = {
                codigolista: listaId,
                codigoproduto: $(this).find('td:eq(0)').attr('data-id'),
                quantidade: $(this).find('td:eq(1)').text()
            };
    
            produtos.push(produto);
        });
    
        if (produtos.length > 0) {
            $.ajax({
                url: 'adicionar_produto.php',
                type: 'POST',
                data: { produtos: produtos },
                success: function(response) {
                    console.log(response);
                    $('#tabelaProdutos tbody').empty();
                    exibirModalSucesso();
                },
                error: function() {
                    alert('Erro ao enviar os produtos.');
                }
            });
        }
    }  

    function exibirModalSucesso() {
        var modal = $('#mensagemModal');
        modal.find('.modal-body').text('Produtos adicionados na lista com sucesso!');
        modal.modal('show');
    }
});

// Mostra os produtos da lista
$(document).ready(function() {
    $('.btn-detalhes').click(function() {
        var listaId = $(this).data('id');
        $.ajax({
            url: 'detalhes_lista.php?id=' + listaId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.length > 0) {
                    $('#listaProdutos').empty();
                    response.forEach(function(produto) {
                        $('#listaProdutos').append('<li>' + produto.Descricao + '</li>');
                    });
                    $('#detalhesModal').modal('show');
                } else {
                    alert('Nenhum produto encontrado na lista.');
                }
            },
            error: function(xhr, status, error) {
                alert('Erro ao obter os detalhes da lista.');
            }
        });
    });
});

