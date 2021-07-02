<?php

namespace App\Observers;

use App\Models\Tables;
use Illuminate\Support\Str;

class TableObserver
{
    /**
     * Handle the table "created" event.
     *
     * @param  \App\Models\Tables  $table
     * @return void
     */
    public function creating(Tables $table)
    {
        $table->uuid = Str::uuid();
    }

}
