<?php
class Curso {
    private $idCurso;
    private $nomeCurso;
    private $cargaHorariaCurso;
    private $professores;
    private $coordenador;
    private $alunos;
    private $disciplinas;
    
    public function __construct($nomeCurso, $cargaHorariaCurso) {
        $this->nomeCurso = $nomeCurso;
        $this->cargaHorariaCurso = $cargaHorariaCurso;
        $this->professores = array();
        $this->coordenador = null;
        $this->alunos = array();
        $this->disciplinas = array();
    }
    
    // Métodos getters e setters
    
    public function getIdCurso() {
        return $this->idCurso;
    }
    
    public function getNomeCurso() {
        return $this->nomeCurso;
    }
    
    public function getCargaHorariaCurso() {
        return $this->cargaHorariaCurso;
    }
    
    public function addProfessor($professor) {
        $this->professores[] = $professor;
    }
    
    public function getProfessores() {
        return $this->professores;
    }
    
    public function setCoordenador($coordenador) {
        $this->coordenador = $coordenador;
    }
    
    public function getCoordenador() {
        return $this->coordenador;
    }
    
    public function addAluno($aluno) {
        $this->alunos[] = $aluno;
    }
    
    public function getAlunos() {
        return $this->alunos;
    }
    
    public function addDisciplina($disciplina) {
        $this->disciplinas[] = $disciplina;
    }
    
    public function getDisciplinas() {
        return $this->disciplinas;
    }
}

?>
