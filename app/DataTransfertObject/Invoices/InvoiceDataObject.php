<?php

declare(strict_types=1);

namespace App\DataTransfertObject\Invoices;

final class InvoiceDataObject
{
    public function __construct(
        private readonly string $total_vat,
        private readonly string $total_price_excluding_vat,
        private readonly int $userId
        ) {}
        
        public function toArray():array
        {
            return [
                'userId' => $this->userId,
                'totalVat' => $vat = $this->total_vat,
                'totalPriceExcludingVat' => $price = $this->total_price_excluding_vat,
                'totalPrice' => (float) $vat + (float) $price
            ];
        }

}
