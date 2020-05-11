<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContaTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Efetua um teste para exibir o saldo.
     *
     * @return void
     */
    public function testSaldo()
    {
        $this->get('/api/depositar/12345/100');
        $response = $this->get('/api/saldo/12345');

        $response         
            ->assertStatus(200)
            ->assertJson([
                'saldo' => 100
            ]);
    }

    /**
     * Efetua um teste para a função depositar.
     *
     * @return void
     */
    public function testDepositar()
    {
        $response = $this->get('/api/depositar/123456/100');

        $response
            ->assertStatus(200)
            ->assertJson([
                'conta' => 123456,
                'saldo' => 100
            ]);
    }

    /**
     * Testa a funcionalidade de saque.
     *
     * @return void
     */
    public function testSacar()
    {
        $this->get('/api/depositar/1234567/450');
        $response = $this->get('/api/sacar/1234567/230');

        $response
            ->assertStatus(200)
            ->assertJson([
                'conta' => 1234567,
                'saldo' => 220,
            ]);

    }

    /**
     * Testa a validação de conta.
     *
     * @return void
     */
    public function testValidarConta()
    {
        
        $response = $this->get('/api/saldo/12345');

        $response
            ->assertStatus(200)
            ->assertJson([                
                'erro' => 'Conta inexistente'
            ]);
    }

    /**
     * Testa se foi efetuado um depósito com valor vazio.
     *
     * @return void
     */
    public function testVerificaValorVazio()
    {
                  
        $response = $this->get('/api/depositar/54321/0');

        $response
            ->assertStatus(200)
            ->assertJson([
                
                'erro' => 'Deposito vazio invalido.'
            ]);
    }


}
