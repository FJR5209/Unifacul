<?php
    require_once 'C:\xampp\htdocs\Projeto\Classes\Conta.php';
    require_once 'C:\xampp\htdocs\Projeto\Classes\ContaCorrente.php';
    require_once 'C:\xampp\htdocs\Projeto\Classes\ContaPoupanca.php';

    //Criando array constas
    $contas = array();

    //Criando cada conta
    $contas[] = new ContaCorrente (8166, "CC 123.123-1", 10000.0, 8000.0);
    $contas[] = new ContaPoupanca (8166, "CP 144.144-5", 20000.0);

    //Percorrendo contas
    foreach ($contas as $key => $conta) {
        print "<br>{$conta->info()}<br>";
        print "<br>Saldo atual (R$): {$conta->getSaldoConta()}<br>";

        //Realizando depósitos
        $conta->depositar (1000.0);

        print "<br><br>{$conta->info()}<br>";
        print "<br>Saldo atual (R$): {$conta->getSaldoConta()}<br>";

        //Realizando retiradas
        //Polimorfismo
        if ($conta->sacar(10000.0)) {
            print "<br><br>{$conta->info()}<br>";
            print "<br>Saldo atual (R$): {$conta->getSaldoConta()}<br>";
            print "<br>Saque de R$ 10.000,00 realizado com sucesso!<br>";
        }
        else {
            print "<br><br>{$conta->info()}<br>";
            print "<br>Saldo atual (R$): {$conta->getSaldoConta()}<br>";
            print "<br>Saque de R$ 1000,00 não autorizado!<br>";
        }

    } //Fim do foreach ()
    




?>