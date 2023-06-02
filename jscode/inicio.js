function carregarConteudo(menu) {
    $.ajax({
        url: 'api.php',
        method: 'POST',
        data: { menu: menu },
        success: function (response) {
            $('#conteudo').html(response);
        },
        error: function () {
            alert('Erro ao carregar o conteúdo.');
        }
    });
}