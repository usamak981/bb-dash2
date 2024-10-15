<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ReferencesExport implements FromView, WithEvents
{
    use RegistersEventListeners;
    private $references;

    public function __construct($references)
    {
        $this->references = $references;
    }

    /**
     * @return view
     */
    public function view(): View
    {
        return view('content.exports.export_references', [
            'references' => $this->references
        ]);
    }

    public static function afterSheet(AfterSheet $event)
    {
        // Create Style Arrays
        $default_font_style = [
            'font' => ['name' => 'Arial', 'size' => 10,'bold' => true]
        ];


        // Get Worksheet
        $active_sheet = $event->sheet->getDelegate();

        $active_sheet->getStyle('A1:S1')->applyFromArray($default_font_style);
        $active_sheet->getStyle('A1:S1')->getFill()->applyFromArray(['fillType' => 'solid','rotation' => 0, 'color' => ['rgb' => 'EEEEEE']]);

    }

}
