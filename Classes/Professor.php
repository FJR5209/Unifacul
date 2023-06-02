<?php
class Professor {
    private $idProfessor;
    private $nomeProfessor;
    private $matriculaProfessor;
    private $escolaridade;
    private $especialidade;
    
    public function __construct($idProfessor, $nomeProfessor, $matriculaProfessor, $escolaridade, $especialidade) {
        $this->idProfessor = $idProfessor;
        $this->nomeProfessor = $nomeProfessor;
        $this->matriculaProfessor = $matriculaProfessor;
        $this->escolaridade = $escolaridade;
        $this->especialidade = $especialidade;
    }
    
    // Métodos getters
    
    public function getIdProfessor() {
        return $this->idProfessor;
    }
    
    public function getNomeProfessor() {
        return $this->nomeProfessor;
    }
    
    public function getMatriculaProfessor() {
        return $this->matriculaProfessor;
    }
    
    public function getEscolaridade() {
        return $this->escolaridade;
    }
    
    public function getEspecialidade() {
        return $this->especialidade;
    }
}
?>