<?php

    //Classe Conta
    class Conta {
        //Atributos
        private $agencia;
        private $numConta;
        protected $saldoConta;

        //Métodos
        //Método construct()
        public function __construct ($ag, $conta, $saldo) {
            $this->setAgencia($ag);
            $this->setNumConta($conta);
            $this->setSaldoConta($saldo);
        }//Fim do método construct()

        //Método setAgencia()
        public function setAgencia ($ag) {
            $this->agencia = $ag;
        }//Fim do método setAgencia()

        //Método getAgencia()
        public function getAgencia () {
            return $this->agencia;
        }//Fim do método getAgencia()

        //Método setNumConta()
        public function setNumConta($conta) {
            $this->numConta = $conta;
        }//Fim do método setNumConta()

        //Método getNumConta()
        public function getNumConta () {
            return $this->numConta;
        }//Fim do método getNumConta()
        
        //Método depositar()
        public function depositar ($quantia) {
            if ($quantia > 0.0) {
                $this->saldoConta += $quantia;
            } 
        } //Fim do método depositar

        //Método setSaldoConta()
        public function setSaldoConta($saldo) {
            if ($saldo > 0.0) {
                $this->saldoConta = $saldo;
            }
            else {
                $this->saldoConta = 0.0;
            }
        }//Fim do setSaldoConta
 
        //Método getSaldoConta()
        public function getSaldoConta() {
            return $this->saldoConta;
        }//Fim do método setSaldoConta()

        //Método info()
        public function info () {
            return "<br>Agência: {$this->getAgencia()}, Conta: {$this->getNumConta()}<br>";
        } //Fim do método info()
        
    } //Fim da classe Conta
?>