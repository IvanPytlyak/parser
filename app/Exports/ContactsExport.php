<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class ContactsExport implements FromCollection
{
    protected $results;
    /**
     * @return \Illuminate\Support\Collection
     */


    public function __construct($results)
    {
        $this->results = $results;
    }

    public function collection()
    {

        return collect($this->results);
    }
}
