<?php

    //Classe ContaPoupanca
    class ContaPoupanca extends Conta {
        
        //Método sacar()
        public function sacar($quantia) {
            if ($this->saldoConta >= $quantia) {
                $this->saldoConta -= $quantia;
            }
            else {
                return false; //retirada não autorizada
            }
            return true; //retirada autorizada
        }//Fim do método sacar()
        
    }//Fim da classe ContaPoupanca

//Não existe saque com valor superior ao saldo
?>

