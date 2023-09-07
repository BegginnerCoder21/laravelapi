<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Invoice;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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

    public function test_api_store_invoice():void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        // $invoices = Invoice::factory()->create([
        //     'user_id' => $user->id
        // ]);
        $invoice = [
            'total_vat' => $vat = 1500.40,
            'total_price_excluding_vat' => $price = 1500.10,
            'total_price' => $vat + $price,
            'user_id' => $user->id
        ];

        $response = $this->postJson('/api/invoices/store',$invoice);

        $response->assertStatus(200);
        $this->assertDatabaseCount('invoices',1);
        $this->assertDatabaseHas('invoices',$invoice);
    }
}
