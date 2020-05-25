<?php

namespace App\Exports;

use App\Models\BookRoom;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;

class OrderExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    protected $id;

    function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        $orderDetail =  Order::find($this->id)->orderDetail;
        $i = 1;
        foreach ($orderDetail as $row) {

            $order[] = array(
                '0' => $i,
                '1' => $row->so_luong,
                '2' => number_format($row->don_gia),
                '3' => number_format($row->thanh_tien),
                '4' => $row->mat_hang_id,
                '5' => $row->created_at,
            );
            $i ++;
        }
        
        $order[] = array([
            0 => '',
            1 => '',
            2 => '',
            3 => '',
            4 => '',
            5 => '',
        ],
        [
            0 => '',
            1 => '',
            2 => '',
            3 => '',
            4 => '',
            5 => '',
        ]);
        
        $order[] = array(
            '0' => '',
            '1' => '',
            '2' => '',
            '3' => 'Tiền phòng',
            '4' => number_format(Order::find($this->id)->room->typeroom->gia_phong *  Order::find($this->id)->room->bookRoom->last()->thoi_gian_dat ). ' vnđ',
        );
        $order[] = array(
            '0' => '',
            '1' => '',
            '2' => '',
            '3' => 'Tổng tiền',
            '4' => number_format(Order::find($this->id)->tong_tien). ' vnđ',
        );

        return (collect($order));
    }

    public function headings(): array
    {
        return [
            '#',
            'so luong',
            'don gia (vnđ)',
            'thanh tien (vnđ)',
            'mat hang',
            'thoi gian'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
