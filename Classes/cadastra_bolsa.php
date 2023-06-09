<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores enviados pelo formulário
    $nome = $_POST["nome"];
    $descricao = $_POST["mensagem"];
    $professor = $_POST["professor"];

    // Conecta ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "universidade";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Prepara o comando SQL para inserção
    $sql = "INSERT INTO bolsa (nomeBolsa, descricao, professor) VALUES ('$nome', '$descricao', '$professor')";

    // Executa o comando SQL
    if ($conn->query($sql) === TRUE) {
        echo "Cadastro da bolsa realizado com sucesso.";
    } else {
        echo "Erro ao cadastrar a bolsa: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>
