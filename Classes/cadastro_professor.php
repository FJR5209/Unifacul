<?php
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "universidade");

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nomeProfessor = $_POST["nome"];
    $matriculaProfessor = $_POST["matricula"];
    $escolaridade = $_POST["escolaridade"];
    $especialidade = $_POST["especialidade"];
    $login = $_POST["login"];
    $senha = $_POST["senha"];

    try {
        // Conexão com o banco de dados usando a API PDO
        $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);

        // Define o modo de erro do PDO para exceção
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara a consulta SQL para inserir os dados do professor na tabela "professor"
        $stmt = $conn->prepare("INSERT INTO professor (nomeProfessor, matriculaProfessor, escolaridade, especialidade) 
                                VALUES (?, ?, ?, ?)");
        $stmt->execute([$nomeProfessor, $matriculaProfessor, $escolaridade, $especialidade]);

        // Prepara a consulta SQL para inserir os dados de login na tabela "Login"
        $stmtLogin = $conn->prepare("INSERT INTO Login (username, password) VALUES (?, ?)");
        $stmtLogin->execute([$login, $senha]);

        // Verifica as credenciais de login
        $stmtCheckLogin = $conn->prepare("SELECT * FROM Login WHERE username = ? AND password = ?");
        $stmtCheckLogin->execute([$login, $senha]);

        if ($stmtCheckLogin->rowCount() > 0) {
            // As credenciais estão corretas, redireciona para a página de sucesso
            header("Location: ../paginas/login.html");
            exit();
        } else {
            // As credenciais estão incorretas, exibe uma mensagem de erro
            echo "Credenciais de login inválidas.";
        }

        // Fecha a conexão com o banco de dados
        $conn = null;
    } catch (PDOException $e) {
        echo "Erro ao inserir dados: " . $e->getMessage();
    }
}
?>
