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

// Consultar as disciplinas na tabela "disciplina"
$query = "SELECT nomeDisciplina FROM disciplina";
$result = $conn->query($query);

// Array para armazenar as opções das disciplinas
$disciplinas = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $nomeDisciplina = $row["nomeDisciplina"];
        $disciplinas[] = $nomeDisciplina;
    }
}

// Verificar a matrícula do aluno
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeAluno = $_POST["nomeAluno"];
    $matriculaAluno = $_POST["matriculaAluno"];
    $nomeDisciplina = $_POST["nomeDisciplina"];

    // Verificar se a matrícula do aluno corresponde ao nome do aluno na tabela "aluno"
    $query = "SELECT idAluno FROM aluno WHERE nomeAluno = '$nomeAluno' AND matriculaAluno = '$matriculaAluno'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // O nome do aluno e a matrícula correspondem a um registro na tabela "aluno"
        $row = $result->fetch_assoc();
        $idAluno = $row["idAluno"];

        // Consultar o ID da disciplina na tabela "disciplina" com base no nome
        $query = "SELECT idDisciplina FROM disciplina WHERE nomeDisciplina = '$nomeDisciplina'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // O nome da disciplina existe na tabela "disciplina"
            $row = $result->fetch_assoc();
            $idDisciplina = $row["idDisciplina"];

            // Inserir os dados na tabela "aluno_disciplina"
            $query = "INSERT INTO aluno_disciplina (idAluno, idDisciplina) VALUES ('$idAluno', '$idDisciplina')";

            if ($conn->query($query) === true) {
                // Redirecionar para a página inicial
                header("Location: ../paginas/inicial.html");
                exit;
            } else {
                echo "<script>alert('Erro ao realizar a matrícula: " . $conn->error . "'); window.location.href = '../Classes/aluno_disciplina.php';</script>";
                exit;
            }
        } else {
            echo "<script>alert('A disciplina selecionada não corresponde a nenhum registro.'); window.location.href = '../Classes/aluno_disciplina.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('A matrícula do aluno não corresponde ao nome do aluno ou não corresponde a nenhum registro.'); window.location.href = '../Classes/aluno_disciplina.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style1/disciplina.css">
        <title>Matrícula</title>
</head>

<body>

    <h2>Matrícula do Aluno</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
        <label for="nomeAluno">Nome do Aluno:</label>
        <input type="text" id="nomeAluno" name="nomeAluno" required><br><br>

        <label for="matriculaAluno">Matrícula do Aluno:</label>
        <input type="text" id="matriculaAluno" name="matriculaAluno" required><br><br>

        <label for="nomeDisciplina">Nome da Disciplina:</label>
        <select id="nomeDisciplina" name="nomeDisciplina" required>
            <?php
            // Exibir as opções das disciplinas
            foreach ($disciplinas as $disciplina) {
                echo "<option value='$disciplina'>$disciplina</option>";
            }
            ?>
           
        </select><br><br>

        <input class="btn" type="submit" value="Enviar">
    </form>
</body>

</html>
