<?php

namespace App\Http\Controllers;

use App\Fetch\FetchInvoiceForUser;
use App\Models\Invoice;
use App\Responses\Invoices\InvoiceCollectionResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    

    public function __invoke(Request $request):InvoiceCollectionResponse
    {
    //    return new InvoiceCollectionResponse(
    //     Invoice::query()
    //    ->with(['user'])
    //    ->where('user_id',$request->user()->id)
    //    ->paginate(15),

    //    status:200
    //    ); 

        return new InvoiceCollectionResponse((
            (new FetchInvoiceForUser())
            ->handle(Invoice::query(),$request->user()->id))
            ->paginate(15),
            status:200
    );
    }
}
