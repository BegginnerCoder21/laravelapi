<?php

namespace App\Fetch;

use Illuminate\Database\Eloquent\Builder;

final class FetchInvoiceForUser{

    public function handle(Builder $query,string $id)
    {
      return  $query->with(['user'])
        ->where('user_id',$id);
    }
}