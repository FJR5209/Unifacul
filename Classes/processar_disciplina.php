<?php
require_once 'Disciplina.php';
require_once 'Conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeDisciplina = $_POST['nomeDisciplina'];
    $cargaHoraria = $_POST['cargaHorariaDisciplina'];
    $nomeProfessor = $_POST['professor'];

    $conexao = new Conexao();

    // Realizar a consulta para obter o idProfessor correspondente
    $sql = "SELECT idProfessor FROM professor WHERE nomeProfessor = ?";
    $stmt = $conexao->getConn()->prepare($sql);
    $stmt->bind_param("s", $nomeProfessor);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $idProfessor = $row['idProfessor'];

    // Criar objeto Disciplina
    $disciplina = new Disciplina($nomeDisciplina, $cargaHoraria, $idProfessor);

    // Inserir a disciplina no banco de dados
    $sql = "INSERT INTO disciplina (nomeDisciplina, cargaHorariaDisciplina, idProfessor) VALUES (?, ?, ?)";
    $stmt = $conexao->getConn()->prepare($sql);
    $stmt->bind_param("ssi", $nomeDisciplina, $cargaHoraria, $idProfessor);

    if ($stmt->execute()) {
        $mensagem = "Disciplina cadastrada com sucesso!";
        echo "<script>alert('$mensagem'); window.location.href = '../paginas/inicial_professor.html';</script>";
    } else {
        echo "Erro ao inserir os dados no banco de dados: " . $stmt->error;
    }

    $stmt->close();

    // Fechar a conexão com o banco de dados
    $conexao->fecharConexao();
} else {
    echo "Método inválido. Apenas solicitações POST são permitidas.";
}
?>
