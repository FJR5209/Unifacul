<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "universidade";

// Inclui a classe Curso
include "curso.php";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nomeCurso = $_POST["nome"];
    $cargaHorariaCurso = $_POST["carga_horaria"];

    // Cria a conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Cria um objeto Curso
    $curso = new Curso($nomeCurso, $cargaHorariaCurso);

    // Prepara e executa a query SQL para inserir os dados na tabela
    $sql = "INSERT INTO curso (nomeCurso, cargaHorariaCurso) VALUES ('$curso->nome', $curso->cargaHoraria)";
    if ($conn->query($sql) === true) {
        echo "Curso adicionado com sucesso.";
    } else {
        echo "Erro ao adicionar o curso: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>
