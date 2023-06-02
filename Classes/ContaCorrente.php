<?php
    //Classe ContaCorrente
    class ContaCorrente extends Conta{
        protected $limiteConta;

        //Método construct()
        public function __construct ($ag, $conta, $saldo, $limite) {
            parent::__construct($ag, $conta, $saldo);
            $this->setLimiteConta($limite);
        }//Fim do método construct()

        //Método setLimiteConta()
        public function setLimiteConta ($limite) {
            $this->limiteConta = $limite;
        }//Fim do método setLimiteConta()

        //Método getLimiteConta()
        public function getLimiteConta () {
            return $this->limiteConta;
        }//Fim do método getLimiteConta()

        //Método sacar() 
        public function sacar ($quantia) {
            if (($this->saldoConta + $this->limiteConta) >= $quantia) {
                $this->saldoConta -= $quantia;
            }
            else {
                return false; //retirada não autorizada
            }
            return true; //retirada autorizada
        }//Fim do método sacar()

    } //Fim ContaCorrente
    


?>