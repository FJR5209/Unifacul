<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "universidade";

// Inclui a classe Curso
include "curso.php";

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o campo "nome" foi enviado
    if (isset($_POST["nome"])) {
        $nomeCurso = $_POST["nome"];
    } else {
        echo '<script>alert("O campo nome não foi informado.");</script>';
        exit;
    }

    // Verifica se o campo "carga_horaria" foi enviado
    if (isset($_POST["carga_horaria"])) {
        $cargaHorariaCurso = $_POST["carga_horaria"];
    } else {
        echo '<script>alert("O campo carga_horaria não foi informado.");</script>';
        exit;
    }

    // Verifica se o campo "coordenador" foi enviado
    if (isset($_POST["coordenador"])) {
        $coordenador = $_POST["coordenador"];
    } else {
        echo '<script>alert("O campo coordenador não foi informado.");</script>';
        exit;
    }

    // Cria a conexão com o banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Prepara a consulta SQL para obter o ID do professor com base no nome
    $sql = "SELECT idProfessor FROM professor WHERE nomeProfessor = '$coordenador'";

    // Executa a consulta SQL
    $result = $conn->query($sql);

    // Verifica se a consulta retornou algum resultado
    if ($result->num_rows > 0) {
        // Obtém o ID do professor
        $row = $result->fetch_assoc();
        $idProfessor = $row["idProfessor"];

        // Cria um objeto Curso
        $curso = new Curso($nomeCurso, $cargaHorariaCurso);

        // Prepara e executa a query SQL para inserir os dados na tabela "curso"
        $sql = "INSERT INTO curso (nomeCurso, cargaHorariaCurso, coordenador) VALUES ('" . $curso->getNomeCurso() . "', " . $curso->getCargaHorariaCurso() . ", '$coordenador')";
        if ($conn->query($sql) === true) {
            echo '<script>alert("Curso adicionado com sucesso."); window.location.href = "../paginas/inicial_professor.html";</script>';
        } else {
            echo '<script>alert("Erro ao adicionar o curso: ' . $conn->error . '"); window.location.href = "../paginas/inicial_professor.html";</script>';
        }
    } else {
        echo '<script>alert("Professor não encontrado."); window.location.href = "../paginas/inicial_professor.html";</script>';
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>
