<?php

namespace App\Http\Controllers;

use App\Conta;
use Illuminate\Http\Request;

class ContaController extends Controller  
{   
    public function consultaContaCorrente($conta)
    {
        return Conta::where('numero', $conta)->first();
    }
    

    public function saldo($conta)
    {        
        
        if ( ! $this->consultaContaCorrente($conta)) {
            return [
                'erro' => 'Conta inexistente'
            ];
        }

        return [           
            'saldo' => $this->consultaContaCorrente($conta)->saldo
        ];       
    }

    public function depositar($conta, $valor) 
    {        

        if (! $this->consultaContaCorrente($conta)) {
            $retorno = Conta::create([
                'numero' => $conta, 
                'saldo' => $valor,
            ]);

            return [
                'conta' => $retorno->numero,
                'saldo' => $retorno->saldo
            ];
        } 
        
        if ($valor == 0 ) {
            return [
                'erro' => 'Deposito vazio invalido.'
            ];
        }
        
        $this->consultaContaCorrente($conta)->increment('saldo', $valor);
        
        return [
            'conta' => $this->consultaContaCorrente($conta)->numero,
            'saldo' => $this->consultaContaCorrente($conta)->saldo
        ];
    }

    public function sacar($conta, $valor) 
    {        

        if (! $this->consultaContaCorrente($conta)) {
            return [
                'erro' => 'Conta inexistente'
            ];

        }

        if ($valor == 0) {
            return [
                'erro' => 'Nao deve ter saque vazio'
            ];
        }

        if ($valor > $this->consultaContaCorrente($conta)->saldo) {
            return [
                'erro' => 'Saldo insuficiente'
            ];
        }

        $this->consultaContaCorrente($conta)->decrement('saldo', $valor);

        return [
            'conta' => $this->consultaContaCorrente($conta)->numero,
            'saldo' => $this->consultaContaCorrente($conta)->saldo
        ];       
    }
}
