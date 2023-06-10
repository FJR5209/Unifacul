<?php
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "universidade");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados recebidos do formulário
    $nomeBolsa = $_POST["nome"];
    $professor = $_POST["professor"];
    $tipo = $_POST["tipo"];

    // Criar a conexão com o banco de dados
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Verificar se houve algum erro na conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Inserir dados na tabela "bolsa"
    $sql = "INSERT INTO bolsa (nomeBolsa, professor, tipo) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nomeBolsa, $professor, $tipo);
    
    if ($stmt->execute()) {
        echo "Dados inseridos com sucesso na tabela bolsa.";
    } else {
        echo "Erro ao inserir dados na tabela bolsa: " . $stmt->error;
    }

    // Fechar a conexão
    $stmt->close();
    $conn->close();
}
?>
