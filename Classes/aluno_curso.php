<?php
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "universidade");

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeAluno = $_POST["nomeAluno"];
    $numeroMatricula = $_POST["numeroMatricula"];
    $nomeCurso = $_POST["nomeCurso"];

    // Criar a conexão com o banco de dados
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Verificar se houve algum erro na conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Verificar se o número de matrícula existe na tabela "aluno"
    $query = "SELECT idAluno FROM aluno WHERE matriculaAluno = '$numeroMatricula'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // O número de matrícula existe na tabela "aluno"

        // Obter o ID do aluno
        $row = $result->fetch_assoc();
        $idAluno = $row["idAluno"];

        // Consultar o ID do curso na tabela "curso"
        $query = "SELECT idCurso FROM curso WHERE nomeCurso = '$nomeCurso'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // O nome do curso existe na tabela "curso"

            // Obter o ID do curso
            $row = $result->fetch_assoc();
            $idCurso = $row["idCurso"];

            // Verificar se o aluno já está matriculado no curso
            $query = "SELECT * FROM aluno_curso WHERE idAluno = $idAluno AND idCurso = $idCurso";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                echo '<script>alert("Você já está matriculado neste curso."); window.location.href = "../paginas/aluno_curso.html";</script>';
                exit();
            } else {
                // Inserir os dados na tabela "aluno_curso"
                $query = "INSERT INTO aluno_curso (idAluno, idCurso) VALUES ($idAluno, $idCurso)";

                if ($conn->query($query) === true) {
                    echo '<script>alert("Matrícula realizada com sucesso."); window.location.href = "../paginas/inicial.html";</script>';
                    exit();
                } else {
                    echo '<script>alert("Erro ao realizar a matrícula: ' . $conn->error . '"); window.location.href ="../paginas/aluno_curso.html";</script>';
                    exit();
                }
            }
        } else {
            echo '<script>alert("O nome do curso não foi encontrado."); window.location.href = "../paginas/aluno_curso.html";</script>';
            exit();
        }
    } else {
        echo '<script>alert("O número de matrícula não foi encontrado."); window.location.href = "../paginas/aluno_curso.html";</script>';
        exit();
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}
?>
