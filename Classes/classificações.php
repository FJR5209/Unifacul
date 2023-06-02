<?php
class Aluno {
    private $idAluno;
    private $nomeAluno;
    private $matriculaAluno;
    
    public function __construct($idAluno, $nomeAluno, $matriculaAluno) {
        $this->idAluno = $idAluno;
        $this->nomeAluno = $nomeAluno;
        $this->matriculaAluno = $matriculaAluno;
    }
    
    // Métodos getters e setters
    
    public function getIdAluno() {
        return $this->idAluno;
    }
    
    public function getNomeAluno() {
        return $this->nomeAluno;
    }
    
    public function getMatriculaAluno() {
        return $this->matriculaAluno;
    }
}

class AlunoMedio extends Aluno {
    private $tipo; // integrado, subsequente, concomitantemente ou proeja
    
    public function __construct($idAluno, $nomeAluno, $matriculaAluno, $tipo) {
        parent::__construct($idAluno, $nomeAluno, $matriculaAluno);
        $this->tipo = $tipo;
    }
    
    // Métodos getters e setters
    
    public function getTipo() {
        return $this->tipo;
    }
}

class AlunoSuperior extends Aluno {
    private $curso;
    
    public function __construct($idAluno, $nomeAluno, $matriculaAluno, $curso) {
        parent::__construct($idAluno, $nomeAluno, $matriculaAluno);
        $this->curso = $curso;
    }
    
    // Métodos getters e setters
    
    public function getCurso() {
        return $this->curso;
    }
}

class AlunoPosGraduacao extends Aluno {
    private $programa;
    
    public function __construct($idAluno, $nomeAluno, $matriculaAluno, $programa) {
        parent::__construct($idAluno, $nomeAluno, $matriculaAluno);
        $this->programa = $programa;
    }
    
    // Métodos getters e setters
    
    public function getPrograma() {
        return $this->programa;
    }
}
?>