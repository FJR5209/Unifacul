<?php
class Disciplina {
    private $idDisciplina;
    private $nomeDisciplina;
    private $cargaHorariaDisciplina;
    private $professor;
    private $alunos;
    
    public function __construct($idDisciplina, $nomeDisciplina, $cargaHorariaDisciplina) {
        $this->idDisciplina = $idDisciplina;
        $this->nomeDisciplina = $nomeDisciplina;
        $this->cargaHorariaDisciplina = $cargaHorariaDisciplina;
        $this->professor = null;
        $this->alunos = array();
    }
    
    // Métodos getters e setters
    
    public function getIdDisciplina() {
        return $this->idDisciplina;
    }
    
    public function getNomeDisciplina() {
        return $this->nomeDisciplina;
    }
    
    public function getCargaHorariaDisciplina() {
        return $this->cargaHorariaDisciplina;
    }
    
    public function setProfessor($professor) {
        $this->professor = $professor;
    }
    
    public function getProfessor() {
        return $this->professor;
    }
    
    public function addAluno($aluno) {
        $this->alunos[] = $aluno;
    }
    
    public function getAlunos() {
        return $this->alunos;
    }
}
?>