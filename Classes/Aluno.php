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
    
    // Métodos getters
    
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
?>
