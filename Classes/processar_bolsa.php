<?php
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "universidade");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados recebidos do formulário
    $nome = $_POST["nome"];
    $matricula = $_POST["matricula"];
    $tipoBolsa = $_POST["tipo"];
    $descricao = $_POST["descricao"];

    // Criar a conexão com o banco de dados
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Verificar se houve algum erro na conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Consultar o ID do aluno com base no nome fornecido
    $sql = "SELECT idAluno FROM aluno WHERE nomeAluno = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idAluno = $row["idAluno"];

        // Verificar se o aluno já está matriculado na bolsa
        $sql = "SELECT * FROM aluno_bolsa WHERE idAluno = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idAluno);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Aluno já matriculado na bolsa
            echo "<script>alert('Você já está matriculado nessa bolsa.');</script>";
        } else {
            // Inserir dados na tabela "bolsa"
            $sql = "INSERT INTO bolsa (descricao) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $descricao);
            if ($stmt->execute()) {
                $idBolsa = $stmt->insert_id;

                // Inserir dados na tabela "aluno_bolsa"
                $sql = "INSERT INTO aluno_bolsa (idAluno, nomeBolsa) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $idAluno, $nomeBolsa);
                if ($stmt->execute()) {
                    echo "<script>window.location.href='../paginas/bolsa.html';</script>";
                } else {
                    echo "Erro ao inserir dados na tabela aluno_bolsa: " . $stmt->error;
                }
            } else {
                echo "Erro ao inserir dados na tabela bolsa: " . $stmt->error;
            }
        }
    } else {
        echo "Nenhum aluno encontrado com o nome fornecido.";
    }

    // Fechar a conexão
    $stmt->close();
    $conn->close();
}

?>
