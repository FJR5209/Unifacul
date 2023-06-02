<?php

class Bolsa {
    protected $id;
    protected $nome;

    public function __construct($id, $nome) {
        $this->id = $id;
        $this->nome = $nome;
    }

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }
}

class Pesquisa extends Bolsa {
    protected $area;

    public function __construct($id, $nome, $area) {
        parent::__construct($id, $nome);
        $this->area = $area;
    }

    public function getArea() {
        return $this->area;
    }
}

class Extensao extends Bolsa {
    protected $projeto;

    public function __construct($id, $nome, $projeto) {
        parent::__construct($id, $nome);
        $this->projeto = $projeto;
    }

    public function getProjeto() {
        return $this->projeto;
    }
}

class Monitoria extends Bolsa {
    protected $disciplina;

    public function __construct($id, $nome, $disciplina) {
        parent::__construct($id, $nome);
        $this->disciplina = $disciplina;
    }

    public function getDisciplina() {
        return $this->disciplina;
    }
}

class Ensino extends Bolsa {
    protected $disciplina;

    public function __construct($id, $nome, $disciplina) {
        parent::__construct($id, $nome);
        $this->disciplina = $disciplina;
    }

    public function getDisciplina() {
        return $this->disciplina;
    }
}

class Permanencia extends Bolsa {
    protected $beneficios;

    public function __construct($id, $nome, $beneficios) {
        parent::__construct($id, $nome);
        $this->beneficios = $beneficios;
    }

    public function getBeneficios() {
        return $this->beneficios;
    }
}

// Exemplo de utilização das classes

// Criando uma bolsa de pesquisa
$bolsaPesquisa = new Pesquisa(1, "Bolsa de Pesquisa", "Ciências Sociais");
echo $bolsaPesquisa->getNome(); // Saída: Bolsa de Pesquisa
echo $bolsaPesquisa->getArea(); // Saída: Ciências Sociais

// Criando uma bolsa de extensão
$bolsaExtensao = new Extensao(2, "Bolsa de Extensão", "Projeto ABC");
echo $bolsaExtensao->getNome(); // Saída: Bolsa de Extensão
echo $bolsaExtensao->getProjeto(); // Saída: Projeto ABC

// Criando uma bolsa de monitoria
$bolsaMonitoria = new Monitoria(3, "Bolsa de Monitoria", "Matemática");
echo $bolsaMonitoria->getNome(); // Saída: Bolsa de Monitoria
echo $bolsaMonitoria->getDisciplina(); // Saída: Matemática

// Criando uma bolsa de ensino
$bolsaEnsino = new Ensino(4, "Bolsa de Ensino", "Física");
echo $bolsaEnsino->getNome(); // Saída: Bolsa de Ensino
echo $bolsaEnsino->getDisciplina(); // Saída: Física

// Criando uma bolsa de permanência
$bolsaPermanencia = new Permanencia(5, "Bolsa de Permanência", "Auxílio Moradia, Auxílio Alimentação");
echo $bolsaPermanencia->getNome(); // Saída: Bolsa de Permanência
echo $bolsaPermanencia->getBeneficios(); // Saída: Auxílio Moradia, Auxílio Alimentação
