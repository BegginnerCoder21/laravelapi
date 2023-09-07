<?php 


namespace App\Actions\Invoices;

use App\Models\Invoice;
use Illuminate\Support\Str;

final class StoreInvoiceAction
{
    public function handle(
        int $userId,
        string $totalVat,
        string $totalPriceExcludingVat,
        string $totalPrice
    )
    {
        Invoice::create([
            'invoice_number' => Str::uuid(),
            'total_vat' => $totalVat,
            'total_price_excluding_vat' => $totalPriceExcludingVat,
            'total_price' => $totalPrice,
            'user_id' => $userId
        ]);
    }
}