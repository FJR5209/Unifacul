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

// Consultar as bolsas na tabela "bolsa"
$query = "SELECT idBolsa, nomeBolsa, professor FROM bolsa";
$result = $conn->query($query);

// Array para armazenar as opções das bolsas
$bolsas = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $idBolsa = $row["idBolsa"];
        $nomeBolsa = $row["nomeBolsa"];
        $professor = $row["professor"];
        $bolsas[] = array("idBolsa" => $idBolsa, "nomeBolsa" => $nomeBolsa, "professor" => $professor);
    }
}

// Verificar a matrícula do aluno
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeAluno = $_POST["nomeAluno"];
    $numeroMatricula = $_POST["numeroMatricula"];
    $nomeBolsa = $_POST["nomeBolsa"];

    // Consultar o ID do aluno na tabela "aluno" com base no nome
    $query = "SELECT idAluno FROM aluno WHERE nomeAluno = '$nomeAluno'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // O nome do aluno existe na tabela "aluno"
        $row = $result->fetch_assoc();
        $idAluno = $row["idAluno"];

        // Encontrar a bolsa selecionada
        $selectedBolsa = null;
        foreach ($bolsas as $bolsa) {
            if ($bolsa["nomeBolsa"] === $nomeBolsa) {
                $selectedBolsa = $bolsa;
                break;
            }
        }

        if ($selectedBolsa) {
            $idBolsa = $selectedBolsa["idBolsa"];
            $professor = $selectedBolsa["professor"];

            // Inserir os dados na tabela "aluno_bolsa"
            $query = "INSERT INTO aluno_bolsa (idAluno, idBolsa, nomeBolsa, professor) VALUES ('$idAluno', '$idBolsa', '$nomeBolsa', '$professor')";

            if ($conn->query($query) === true) {
                // Redirecionar para a página inicial
                header("Location: ../paginas/inicial.html");
                exit;
            } else {
                echo "<script>alert('Erro ao realizar a matrícula: " . $conn->error . "'); window.location.href = '../Classes/aluno_bolsa.php';</script>";
                exit;
            }
        } else {
            echo "<script>alert('Bolsa selecionada não encontrada.'); window.location.href = '../Classes/aluno_bolsa.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('O nome do aluno não corresponde a nenhum registro.'); window.location.href = '../Classes/aluno_bolsa.php';</script>";
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
    <title>Matrícula</title>
</head>

<body>
    <h2>Matrícula do Aluno</h2>
    <form action="../paginas/aluno_bolsa.php" method="POST">
        <label for="nomeAluno">Nome do Aluno:</label>
        <input type="text" id="nomeAluno" name="nomeAluno" required><br><br>

        <label for="numeroMatricula">Número de Matrícula:</label>
        <input type="text" id="numeroMatricula" name="numeroMatricula" required><br><br>

        <label for="nomeBolsa">Nome da Bolsa:</label>
        <select id="nomeBolsa" name="nomeBolsa" required>
            <?php
            // Exibir as opções das bolsas
            foreach ($bolsas as $bolsa) {
                echo "<option value='{$bolsa["nomeBolsa"]}'>{$bolsa["nomeBolsa"]}</option>";
            }
            ?>
        </select><br><br>

        <input type="submit" value="Enviar">
    </form>
</body>

</html>
