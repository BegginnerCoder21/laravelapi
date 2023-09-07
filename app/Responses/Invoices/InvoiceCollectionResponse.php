<?php


declare(strict_types=1);

namespace App\Responses\Invoices;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Support\Responsable;
use App\Http\Resources\Invoices\InvoiceCollection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class InvoiceCollectionResponse implements Responsable
{

    public function __construct(
        private readonly Collection|LengthAwarePaginator  $collection,
        private readonly int $status = 200
    ){}


    public function toResponse($request):JsonResponse
    {
        return response()->json([
            'data' => InvoiceCollection::make(
                $this->collection,
            )->response()->getData(),
            'status' => $this->status
        ]); 
    }
}