<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class BulkExport implements FromView
{
    protected $data;

    function __construct($data) {
            $this->data = $data;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

        return view('bulk-report', [
            'keys' => $this->data['keys'],
            'records' => $this->data['rows']
        ]);
    }
}

