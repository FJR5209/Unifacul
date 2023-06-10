<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inscrição na Pós-Graduação</title>
</head>
<body>
    <h1>Inscrição na Pós-Graduação</h1>

    <?php
    // Cria a conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "universidade";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica se a conexão foi estabelecida com sucesso
    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Obtém os programas de pós-graduação cadastrados na tabela "programa_posgraduacao"
    $programasQuery = "SELECT id, nome FROM programa_posgraduacao";
    $programasResult = $conn->query($programasQuery);

    // Verifica se existem programas de pós-graduação cadastrados
    if ($programasResult->num_rows > 0) {
        // Exibe o formulário de inscrição

        echo '<form method="POST" action="' . $_SERVER["PHP_SELF"] . '">';
        echo '<label for="nome">Nome do Aluno:</label>';
        echo '<input type="text" name="nome" required><br>';

        echo '<label for="programa">Programa de Pós-Graduação:</label>';
        echo '<select name="programa" required>';

        // Exibe os programas de pós-graduação como opções do select
        while ($row = $programasResult->fetch_assoc()) {
            $programaId = $row["id"];
            $programaNome = $row["nome"];
            echo '<option value="' . $programaId . '">' . $programaNome . '</option>';
        }

        echo '</select><br>';

        echo '<input type="submit" value="Realizar Inscrição">';
        echo '</form>';
    } else {
        echo "<p>Não há programas de pós-graduação cadastrados.</p>";
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os dados do formulário
        $nomeAluno = $_POST["nome"];
        $programaId = $_POST["programa"];

        // Obtém o ID do aluno com base no nome
        $alunoIdQuery = "SELECT idAluno FROM aluno WHERE nomeAluno = '$nomeAluno'";
        $alunoIdResult = $conn->query($alunoIdQuery);

        // Verifica se o aluno foi encontrado
        if ($alunoIdResult->num_rows > 0) {
            $row = $alunoIdResult->fetch_assoc();
            $alunoId = $row["idAluno"];

            // Insere os dados na tabela aluno_posgraduacao
            $inscricaoQuery = "INSERT INTO aluno_posgraduacao (idAluno, idProgramaPosgraduacao) VALUES ($alunoId, $programaId)";

            if ($conn->query($inscricaoQuery) === true) {
                echo "<p>Inscrição realizada com sucesso!</p>";
                echo "<p>Nome do Aluno: $nomeAluno</p>";
                echo "<p>Programa de Pós-Graduação: $programaId</p>";
            } else {
                echo "<p>Ocorreu um erro ao realizar a inscrição.</p>";
            }
        } else {
            echo "<p>O aluno com o nome $nomeAluno não foi encontrado.</p>";
        }
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
    ?>

</body>
</html>
