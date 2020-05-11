<?php

namespace App\Http\Controllers;

use App\Conta;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    public function saldo($conta)
    {
        
    }

    public function depositar($conta, $valor) 
    {
        $contaCorrente = Conta::where('conta_corrente', $conta)->first();

        if (! $contaCorrente) {
            $retorno = Conta::create([
                'conta_corrente' => $conta, 
                'saldo' => $valor,
            ]);

            return [
                'conta' => $retorno->conta_corrente,
                'saldo' => $retorno->saldo
            ];
        } 
        
        $contaCorrente->increment('saldo', $valor);
        
        return [
            'conta' => $contaCorrente->conta_corrente,
            'saldo' => $contaCorrente->saldo
        ];
    }

    public function sacar() 
    {

    }
}
