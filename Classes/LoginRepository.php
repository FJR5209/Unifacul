<?php
class LoginRepository
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Conexao();
    }

    public function cadastrarLogin($username, $password)
    {
        $sql = "INSERT INTO Login (username, password) VALUES ('$username', '$password')";

        if ($this->conexao->executarConsulta($sql) === true) {
            echo "Dados de login inseridos com sucesso na tabela 'Login'.";
        } else {
            echo "Erro ao inserir dados de login na tabela 'Login': " . $this->conexao->error;
        }
    }

    public function verificarCredenciais($username, $password)
    {
        $sql = "SELECT * FROM Login WHERE username = '$username' AND password = '$password'";
        $result = $this->conexao->executarConsulta($sql);

        if ($result->num_rows > 0) {
            header("Location: ../paginas/inicial.html");
            exit();
        } else {
            echo "Credenciais de login inválidas.";
        }
    }

    // Outros métodos para buscar, atualizar e excluir logins
}
?>
