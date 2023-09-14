<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Fetch\FetchInvoiceForUser;
use App\Actions\Invoices\StoreInvoiceAction;
use App\Responses\Invoices\InvoiceCollectionResponse;
use App\DataTransfertObject\Invoices\InvoiceDataObject;

class StoreController extends Controller
{
    public function __invoke(Request $request):InvoiceCollectionResponse
    {
        $Dto = new InvoiceDataObject(
            $request->total_vat,
            $request->total_price_excluding_vat,
            $request->user()->id
        );

        (new StoreInvoiceAction())
            ->handle(
                ...$Dto->toArray() 
            );

            return new InvoiceCollectionResponse((
                (new FetchInvoiceForUser())
                ->handle(Invoice::query(),$request->user()->id))
                ->paginate(15),
                status:200
            );

    }
}
