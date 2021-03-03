<?php

namespace App\Http\Controllers;

use App\Order;
use App\ProductOrder;
use Illuminate\Http\Request;
use App\Http\helpers;
use PDF;

class OrderController extends Controller
{
    
    public function index()
    {
    	$get_all_order=Order::orderBy('id', 'desc')->get();
        return view('admin.pages.order', compact('get_all_order'));
    }

    public function showinvoice($order_id)
    {
    	$get_all_order=Order::findOrFail($order_id);
        $get_all_order_product=ProductOrder::where('order_id','=', $order_id)->get();
        return view('admin.pages.invoice',compact('get_all_order','get_all_order_product'));
    }

    public function generatepdfinvoice($order_id)
    {
        $invoice_detail=Order::findOrFail($order_id);
        view()->share('invoice',$invoice_detail);
        $pdf=PDF::loadView('admin.pages.invoice_pdf',$invoice_detail);
        return $pdf->download('invoice.pdf');
    }
}
