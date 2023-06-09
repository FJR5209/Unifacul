<?php
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "universidade");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $opcao = $_POST["opcao"];

    // Criar a conexão com o banco de dados
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Verificar se houve algum erro na conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Processar a opção selecionada
    switch ($opcao) {
        case "alunos_por_curso":
            // Consultar os alunos por curso
            $query = "SELECT c.nomeCurso, a.nomeAluno FROM curso c
                      JOIN aluno_curso ac ON c.idCurso = ac.idCurso
                      JOIN aluno a ON ac.idAluno = a.idAluno
                      ORDER BY c.nomeCurso, a.nomeAluno";

            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                echo "<h2>Alunos por Curso</h2>";

                $currentCourse = "";
                while ($row = $result->fetch_assoc()) {
                    $course = $row["nomeCurso"];
                    $student = $row["nomeAluno"];

                    if ($course !== $currentCourse) {
                        echo "<h3>$course</h3>";
                        $currentCourse = $course;
                    }

                    echo "$student<br>";
                }
            } else {
                echo "Nenhum aluno encontrado.";
            }
            break;

        case "alunos_por_disciplina":
            // Consultar os alunos por disciplina
            $query = "SELECT d.nomeDisciplina, a.nomeAluno FROM disciplina d
                      JOIN aluno_disciplina ad ON d.idDisciplina = ad.idDisciplina
                      JOIN aluno a ON ad.idAluno = a.idAluno
                      ORDER BY d.nomeDisciplina, a.nomeAluno";

            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                echo "<h2>Alunos por Disciplina</h2>";

                $currentDiscipline = "";
                while ($row = $result->fetch_assoc()) {
                    $discipline = $row["nomeDisciplina"];
                    $student = $row["nomeAluno"];

                    if ($discipline !== $currentDiscipline) {
                        echo "<h3>$discipline</h3>";
                        $currentDiscipline = $discipline;
                    }

                    echo "$student<br>";
                }
            } else {
                echo "Nenhum aluno encontrado.";
            }
            break;

        default:
            echo "Opção inválida.";
            break;
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
}
?>
