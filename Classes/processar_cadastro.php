<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST["nome"];
    $matricula = $_POST["matricula"];
    $cpf = $_POST["cpf"];
    $login = $_POST["login"];
    $senha = $_POST["senha"];
    $tipo = $_POST["tipo"];

    // Inclui o arquivo de configuração do banco de dados
    require_once "config.php";

    // Cria uma instância do objeto PDO
    $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);

    // Verifica se o login já existe na tabela "Login"
    $sqlCheckLogin = "SELECT * FROM Login WHERE username = :login";
    $stmtCheckLogin = $conn->prepare($sqlCheckLogin);
    $stmtCheckLogin->bindParam(":login", $login);
    $stmtCheckLogin->execute();

    if ($stmtCheckLogin->rowCount() > 0) {
        // O login já existe, exibe o alerta
        echo '<script>alert("O login já está em uso. Por favor, escolha outro login."); history.go(-1);</script>';
        exit();
    }

    // Prepara a consulta SQL para inserir os dados do aluno ou professor
    if ($tipo === "aluno") {
        $curso = $_POST["curso"]; // Obtém o valor do campo de input 'curso'
        $sql = "INSERT INTO Aluno (nomeAluno, matriculaAluno, cpf, aluno_curso) VALUES (:nome, :matricula, :cpf, :curso)";
    } elseif ($tipo === "professor") {
        $escolaridade = $_POST["escolaridade"];
        $especialidade = $_POST["especialidade"];
        $sql = "INSERT INTO Professor (nomeProfessor, matriculaProfessor, cpf, escolaridade, especialidade) VALUES (:nome, :matricula, :cpf, :escolaridade, :especialidade)";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":nome", $nome);
    $stmt->bindParam(":matricula", $matricula);
    $stmt->bindParam(":cpf", $cpf);

    // Verifica o tipo de usuário para fazer o bind dos parâmetros corretos
    if ($tipo === "aluno") {
        $stmt->bindParam(":curso", $curso);
    } elseif ($tipo === "professor") {
        $stmt->bindParam(":escolaridade", $escolaridade);
        $stmt->bindParam(":especialidade", $especialidade);
    }

    // Executa a consulta
    if ($stmt->execute()) {
        echo "Dados inseridos com sucesso na tabela " . ($tipo === "aluno" ? "Aluno" : "Professor") . ".";
    } else {
        echo "Erro ao inserir dados na tabela " . ($tipo === "aluno" ? "Aluno" : "Professor") . ".";
    }

    // Prepara a consulta SQL para inserir os dados de login na tabela "Login"
    $sqlLogin = "INSERT INTO Login (username, password, tipo) VALUES (:login, :senha, :tipo)";
    $stmtLogin = $conn->prepare($sqlLogin);
    $stmtLogin->bindParam(":login", $login);
    $stmtLogin->bindParam(":senha", $senha);
    $stmtLogin->bindParam(":tipo", $tipo);

    // Executa a consulta
    if ($stmtLogin->execute()) {
        echo "Dados de login inseridos com sucesso na tabela 'Login'.";
    } else {
        echo "Erro ao inserir dados de login na tabela 'Login'.";
    }

    // Verifica as credenciais de login
    $sqlCheckLogin = "SELECT * FROM Login WHERE username = :login AND password = :senha";
    $stmtCheckLogin = $conn->prepare($sqlCheckLogin);
    $stmtCheckLogin->bindParam(":login", $login);
    $stmtCheckLogin->bindParam(":senha", $senha);

    // Executa a consulta
    $stmtCheckLogin->execute();

    if ($stmtCheckLogin->rowCount() > 0) {
        // As credenciais estão corretas, redireciona para a página de sucesso
        header("Location: ../paginas/login.html");
        exit();
    } else {
        // As credenciais estão incorretas, exibe uma mensagem de erro
        echo "Credenciais de login inválidas.";
    }
}
?>
