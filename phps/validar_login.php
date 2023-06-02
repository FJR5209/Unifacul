<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "universidade";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $login = $_POST["login"];
    $senha = $_POST["senha"];

    // Cria a conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Consulta o banco de dados para verificar as credenciais de login
    $sql = "SELECT * FROM login WHERE username = '$login' AND password = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // As credenciais estão corretas, verifica o tipo de usuário
        $row = $result->fetch_assoc();
        $tipoUsuario = $row['tipo'];

        if ($tipoUsuario == 'professor') {
            // Redireciona para a página inicial do professor
            header("Location: ../paginas/inicial_professor.html");
            exit();
        } elseif ($tipoUsuario == 'aluno') {
            // Redireciona para a página inicial do aluno
            header("Location: ../paginas/inicial.html");
            exit();
        }
    }

    // Credenciais inválidas ou tipo de usuário desconhecido, exibe uma mensagem de erro
    echo "Credenciais de login inválidas ou tipo de usuário desconhecido.";

    // Fecha a conexão com o banco de dados
    $conn->close();
}


?>