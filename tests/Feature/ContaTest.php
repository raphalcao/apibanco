<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContaTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
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
}
