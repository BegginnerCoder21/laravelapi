<?php

declare(strict_types=1);

namespace App\DataTransfertObject\Invoices;

final class InvoiceDataObject
{
    public function __construct(
        private readonly string $total_vat,
        private readonly string $total_excluding_vat,
    )
    {
        return [
            'total_vat' => $this->total_vat,
            'total_excluding_vat' => $this->total_excluding_vat,
            'total_price' => (float) $this->total_vat + (float) $this->total_excluding_vat
        ];
    }
}