<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log; 
use App\Models\Order;
// use Illuminate\Http\Request;
use PDF;



use Dompdf\Dompdf;
use Dompdf\Options;

class InvoiceController extends Controller
{
    public function generatePDF($orderId)
    {
        $orders = Order::findOrFail($orderId);
     
        $pdf = PDF::loadView('shopping.invoice', compact('orders'));

        $pdf = new Dompdf();
        $pdf->setOptions(new Options(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]));
        
        $html = view('shopping.invoice', compact('orders'))->render();
        
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        
        return $pdf->stream('invoice.pdf'); // Downloads the PDF file directly
    }
}




