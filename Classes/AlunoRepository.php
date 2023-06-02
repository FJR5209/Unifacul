<?php
class AlunoRepository
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function cadastrarAluno($nome, $matricula)
    {
        $sql = "INSERT INTO Aluno (nomeAluno, matriculaAluno) VALUES ('$nome', '$matricula')";

        if ($this->conexao->executarConsulta($sql) === true) {
            echo "Dados do aluno inseridos com sucesso na tabela 'Aluno'.";
        } else {
            echo "Erro ao inserir dados do aluno na tabela 'Aluno': " . $this->conexao->error;
        }
    }

    // Outros métodos para buscar, atualizar e excluir alunos
}
?>
