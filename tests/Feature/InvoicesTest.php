<?php

namespace Tests\Feature;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class InvoicesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_api_returns_invoices_list_user(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $invoices = Invoice::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->getJson('/api/invoices');

        $data = [
            'data' => [
                [
                    'id' => $invoices->id,
                    'total_price' => $invoices->total_price . ' fcfa',
                    'owner' => [
                        'email' => $user->email
                    ]
                ]
            ] 
        ];
        
        $response->assertStatus(200);
        $response->assertJson([
            'data' => $data,
            'status' => 200,
        ]);
    }
}
