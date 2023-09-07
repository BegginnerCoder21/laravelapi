<?php

namespace App\Http\Resources\Invoices;

use Illuminate\Http\Request;
use App\Http\Resources\Invoices\InvoiceResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InvoiceCollection extends ResourceCollection
{

    // public $collects = InvoiceResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
