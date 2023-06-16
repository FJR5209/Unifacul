<?php
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "universidade");

// Criar a conexão com o banco de dados
$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Verificar se houve algum erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Consultar os cursos na tabela "curso"
$query = "SELECT idCurso, nomeCurso FROM curso";
$result = $conn->query($query);

// Array para armazenar as opções dos cursos
$cursos = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $idCurso = $row["idCurso"];
        $nomeCurso = $row["nomeCurso"];
        $cursos[$idCurso] = $nomeCurso;
    }
}

// Verificar a matrícula do aluno
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeAluno = $_POST["nomeAluno"];
    $matriculaAluno = $_POST["matriculaAluno"];
    $nomeCurso = $_POST["nomeCurso"];

    // Consultar o ID do aluno na tabela "aluno" com base na matrícula
    $query = "SELECT idAluno FROM aluno WHERE matriculaAluno = '$matriculaAluno'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // A matrícula do aluno existe na tabela "aluno"
        $row = $result->fetch_assoc();
        $idAluno = $row["idAluno"];

        // Obter o ID do curso com base no nome do curso selecionado
        $idCurso = array_search($nomeCurso, $cursos);

        if ($idCurso !== false) {
            // Inserir os dados na tabela "aluno_curso"
            $query = "INSERT INTO aluno_curso (idAluno, idCurso) VALUES ('$idAluno', '$idCurso')";

            if ($conn->query($query) === true) {
                // Redirecionar para a página inicial
                header("Location: ../paginas/inicial.html");
                exit;
            } else {
                echo "<script>alert('Erro ao realizar a matrícula: " . $conn->error . "'); window.location.href = '../Classes/aluno_curso.php';</script>";
                exit;
            }
        } else {
            echo "<script>alert('O nome do curso não corresponde a nenhum registro.'); window.location.href = '../Classes/aluno_curso.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('A matrícula do aluno não corresponde a nenhum registro.'); window.location.href = '../Classes/aluno_curso.php';</script>";
        exit;
    }
}

// Fechar a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style1/curso.css">
    <title>Matrícula</title>
</head>

<body>
    <h2>Matrícula do Aluno</h2>
    <form action="../paginas/aluno_curso.php" method="POST">
        <label for="nomeAluno">Nome do Aluno:</label>
        <input type="text" id="nomeAluno" name="nomeAluno" required><br><br>

        <label for="matriculaAluno">Matrícula do Aluno:</label>
        <input type="text" id="matriculaAluno" name="matriculaAluno" required><br><br>

        <label for="nomeCurso">Nome do Curso:</label>
        <select id="nomeCurso" name="nomeCurso" required>
            <?php
            // Exibir as opções dos cursos
            foreach ($cursos as $idCurso => $nomeCurso) {
                echo "<option value='$nomeCurso'>$nomeCurso</option>";
            }
            ?>
        </select><br><br>

        <input type="submit" value="Enviar">
    </form>
</body>

</html>
