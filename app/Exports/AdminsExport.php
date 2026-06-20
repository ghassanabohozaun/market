<?php

namespace App\Exports;

use App\Models\Admin;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style;
use PhpOffice\PhpSpreadsheet\Style\Style as DefaultStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AdminsExport implements WithHeadings, FromQuery, WithMapping, WithColumnWidths, ShouldAutoSize, WithStyles, WithEvents
{
    use RegistersEventListeners;
    public $admin;

    protected $columns;

    public function __construct($admin, array $columns)
    {
        $this->admin = $admin;
        $this->columns = $columns;
    }

    public function headings(): array
    {
        // Use the column names as headings
        // return array_map(function ($column) {
        //     return ucwords(str_replace('_', ' ', $column)); // Format for better readability
        // }, $this->columns);

        return array_map(function ($column) {
            return __('admins.' . $column); // Format for better readability
        }, $this->columns);

        // $headings = [];

        // if (in_array('id', $this->columns)) {
        //     $headings['id'] = __('admins.id');
        // }
        // if (in_array('name', $this->columns)) {
        //     $headings['name'] = __('admins.name');
        // }
        // if (in_array('email', $this->columns)) {
        //     $headings['email'] = __('admins.email');
        // }

        // return $headings;
    }

    public function query()
    {
        return Admin::with('role')->select($this->columns);
    }

    public function map($row): array
    {
        unset($this->columns[4]);
        unset($this->columns[5]);

        $items = array_map(function ($column) use ($row) {
            return $row[$column]; // Format for better readability
        }, $this->columns);

        $items['status'] = $row->status  == 1 ? __('general.enable') :  __('general.disabled');
        $items['role_id'] = $row->role->role;

        return [$items];
    }

    public function columnWidths(): array
    {
        return [
            'B' => 30,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // return [
        //     '1' => ['font' => ['bold' => true]],
        // ];
        $sheet->getStyle('1')->getFont()->setBold(true);
        $sheet
            ->getStyle('B1:B' . $sheet->getHighestRow())
            ->getAlignment()
            ->setWrapText(true);
    }

    /**
     * @return array|void
     */
    public function defaultStyles(DefaultStyles $defaultStyle)
    {
        return [
            'font' => [
                'name' => 'Calibri',
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => Style\Alignment::VERTICAL_CENTER,
            ],
        ];
    }

    public static function afterSheet(AfterSheet $event)
    {
        $direction = Lang() == 'ar' ? true : false;
        return $event->sheet->getDelegate()->setRightToLeft($direction);
    }
}
