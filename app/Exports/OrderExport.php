<?php

namespace App\Exports;

use App\Models\BookRoom;
use App\Models\Order;
use App\Models\OrderDetail;
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
            $i++;
        }

        $order[] = array(
            [
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
            ]
        );

        $order[] = array(
            '0' => '',
            '1' => '',
            '2' => '',
            '3' => 'Tiền phòng',
            '4' => number_format(Order::find($this->id)->tong_tien - OrderDetail::where('hoa_don_id', $this->id)->get()->sum('thanh_tien')) . ' vnđ',
        );
        $order[] = array(
            '0' => '',
            '1' => '',
            '2' => '',
            '3' => 'Tổng tiền',
            '4' => number_format(Order::find($this->id)->tong_tien) . ' vnđ',

        );
        $order[] = array([
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
            '3' => 'Khách hàng',
            '4' => Order::find($this->id)->customer->ho_ten,

        );

        $order[] = array(
            '0' => '',
            '1' => '',
            '2' => '',
            '3' => 'Số điện thoại',
            '4' => Order::find($this->id)->customer->so_dien_thoai,

        );

        $order[] = array(
            '0' => '',
            '1' => '',
            '2' => '',
            '3' => 'Thời gian',
            '4' => date('h:s:i d/m/Y',strtotime(Order::find($this->id)->created_at)),

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
            AfterSheet::class    => function (AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }
}
