<?php

namespace App\Http\Controllers;

use App\Conta;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    public function saldo($conta)
    {
        $contaCorrente = Conta::where('numero', $conta)->first();
        
        if (! $contaCorrente) {
            return [
                'erro' => 'Conta inexistente'
            ];
        }

        return [           
            'saldo' => $contaCorrente->saldo
        ];       
    }

    public function depositar($conta, $valor) 
    {
        $contaCorrente = Conta::where('numero', $conta)->first();

        if (! $contaCorrente) {
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
        
        $contaCorrente->increment('saldo', $valor);
        
        return [
            'conta' => $contaCorrente->numero,
            'saldo' => $contaCorrente->saldo
        ];
    }

    public function sacar($conta, $valor) 
    {
        $contaCorrente = Conta::where('numero', $conta)->first();

        if (! $contaCorrente) {
            return [
                'erro' => 'Conta inexistente'
            ];

        }

        if ($valor > $contaCorrente->saldo) {
            return [
                'erro' => 'Saldo insuficiente'
            ];
        }

        $contaCorrente->decrement('saldo', $valor);

        return [
            'conta' => $contaCorrente->numero,
            'saldo' => $contaCorrente->saldo
        ];       
    }
}
