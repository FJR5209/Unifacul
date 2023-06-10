<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST["nome"];
    $nivel = $_POST["nivel"];
    $coordenador = $_POST["coordenador"];

    // Cria a conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "universidade";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Verifica se o nome do coordenador existe na tabela "professor"
    $checkProfessorQuery = "SELECT idProfessor FROM professor WHERE nomeProfessor = '$coordenador'";
    $checkProfessorResult = $conn->query($checkProfessorQuery);

    if ($checkProfessorResult->num_rows > 0) {
        // O nome do professor foi encontrado na tabela "professor"

        // Prepara e executa a query SQL para inserir os dados na tabela "programa_posgraduacao"
        $sql = "INSERT INTO programa_posgraduacao (nome, nivel, coordenador_id) VALUES ('$nome', '$nivel', (SELECT idProfessor FROM professor WHERE nomeProfessor = '$coordenador'))";
        if ($conn->query($sql) === true) {
            echo "<p>Programa de Pós-Graduação criado com sucesso!</p>";
            echo "<p>Nome: $nome</p>";
            echo "<p>Nível: $nivel</p>";
            echo "<p>Coordenador: $coordenador</p>";

            // Adiciona o botão para redirecionar para a página inicial do professor
            echo "<a href='../paginas/inicial_professor.html'>Voltar para a página inicial do professor</a>";
        } else {
            echo "Erro ao criar o programa de pós-graduação: " . $conn->error;
        }
    } else {
        // O nome do professor não foi encontrado na tabela "professor"

        // Exibe um alerta informando que o nome do professor é inválido
        echo "<script>alert('Nome do professor inválido. Verifique novamente.');</script>";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>
