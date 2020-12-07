<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\ProductOrder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportsExport implements FromQuery, WithMapping, WithHeadings, WithEvents, WithColumnFormatting, WithColumnWidths
{
      use Exportable;
      public function from(string $from)
    {
        $this->from = $from;

        return $this;
    }
    public function to(string $to)
  {
      $this->to = $to;

      return $this;
  }
  public function size(){
    $stime = str_replace('/', '-', $this->from);
    $stime = strtotime($stime);
    $stime = date('Y-m-d 00:00:00', $stime);
    $etime = str_replace('/', '-', $this->to);
    $etime = strtotime($etime);
    $etime = date('Y-m-d 23:59:59', $etime);
    $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                     ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                     ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                     ->where('orders.status','=',10)
                     ->groupBy('date')->get();
    $this->size = count($lsReport) + 1;
    return $this;

  }
  public function columnFormats(): array
  {
      return [
          'A' => NumberFormat::FORMAT_DATE_DDMMYYYY,
      ];
  }
  public function columnWidths(): array
  {
      return [
          'A' => 20,
          'B' => 20,
          'C' => 20,
          'D' => 20,
      ];
  }
      /**
      * @return array
      */
     public function registerEvents(): array
     {
        $style = [
          'font' => [
            'bold' => true,
          ]
        ];
        $size = $this->size()->size + 1;

         return [
           AfterSheet::class => function(AfterSheet $event) use ($style,$size){
             $event->sheet->getStyle('A1:D1')->applyFromArray($style);
             $event->sheet->setCellValue('A'.$size, 'Tổng :');
             $isize = $size - 1;
             $event->sheet->setCellValue('B'.$size, '=TEXT(SUM(B2:B'.$isize.'),"#,###")');
             $event->sheet->setCellValue('C'.$size, '=TEXT(SUM(C2:C'.$isize.'),"#,###")');
             $event->sheet->setCellValue('D'.$size, '=TEXT(SUM(D2:D'.$isize.'),"#,###")');
           },
         ];
     }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        $stime = str_replace('/', '-', $this->from);
        $stime = strtotime($stime);
        $stime = date('Y-m-d 00:00:00', $stime);
        $etime = str_replace('/', '-', $this->to);
        $etime = strtotime($etime);
        $etime = date('Y-m-d 23:59:59', $etime);
        $lsReport = Order::join('product_orders', 'orders.id', '=', 'product_orders.order_id')
                         ->select(Order::raw('sum(distinct orders.total) as stotal'),Order::raw('DATE(orders.created_at) as date'),ProductOrder::raw('sum(product_orders.price * product_orders.quantity) as sprice'))
                         ->whereRaw('orders.created_at >= ? AND orders.created_at <= ?',[$stime,$etime])
                         ->where('orders.status','=',10)
                         ->groupBy('date');
        return $lsReport;
    }
    /**
    * @var Invoice $invoice
    */
    public function map($invoice): array
    {
        return [
            date('d-m-Y',strtotime($invoice->date)),
            $invoice->stotal,
            $invoice->sprice,
            $invoice->sprice - $invoice->stotal,
        ];
    }
    public function headings(): array
    {
        return [
          [
            'Ngày', 'Tổng thu', 'Tiền hàng', 'Khuyến mãi'
          ]
        ];
    }

}
