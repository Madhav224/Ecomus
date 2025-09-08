<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ModuleExport implements FromCollection, WithHeadings
{
    protected $data;

    protected $thead;

    public function __construct($data, $thead)
    {
        $this->data  = $data;
        $this->thead = $thead;
    }

/**
 * @return \Illuminate\Support\Collection
 */
    public function collection()
    {
        return $this->data; // Return the data as a collection
    }

/**
 * Get the column headings dynamically from the first row
 * @return array
 */
    public function headings(): array
    {
        return $this->thead; // Return the headings directly
    }

}
