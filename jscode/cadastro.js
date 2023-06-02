function gerarMatricula() {
    var matricula = Math.floor(Math.random() * 1000000).toString().padStart(6, '0');
    document.getElementById("matricula").value = matricula;
}

// Exibe os campos específicos para cada tipo de aluno selecionado
var tipoAluno = document.getElementById("tipo");
var detalhesMedio = document.getElementById("detalhes-medio");
var detalhesSuperior = document.getElementById("detalhes-superior");
var detalhesPosGraduacao = document.getElementById("detalhes-posgraduacao");

tipoAluno.addEventListener("change", function () {
    if (tipoAluno.value === "medio") {
        detalhesMedio.style.display = "block";
        detalhesSuperior.style.display = "none";
        detalhesPosGraduacao.style.display = "none";
    } else if (tipoAluno.value === "superior") {
        detalhesMedio.style.display = "none";
        detalhesSuperior.style.display = "block";
        detalhesPosGraduacao.style.display = "none";
    } else if (tipoAluno.value === "posgraduacao") {
        detalhesMedio.style.display = "none";
        detalhesSuperior.style.display = "none";
        detalhesPosGraduacao.style.display = "block";
    } else {
        detalhesMedio.style.display = "none";
        detalhesSuperior.style.display = "none";
        detalhesPosGraduacao.style.display = "none";
    }
});

// Adiciona evento de submit ao formulário
document.getElementById("cadastroForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Impede o envio do formulário

    Swal.fire({
        title: 'Cadastro Realizado!',
        text: 'O cadastro foi realizado com sucesso.',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(function () {
        // Após o usuário clicar em OK, envie o formulário
        document.getElementById("cadastroForm").submit();
    });
});

// Gera a matrícula automaticamente quando a página é carregada
gerarMatricula();
