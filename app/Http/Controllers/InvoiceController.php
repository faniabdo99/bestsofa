<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use PDF;
use Mail;
//Mails
use App\Mail\OrderInvoiceMail;
//Models
use App\Order;
use App\Invoice;
class InvoiceController extends Controller{
    public function generateInvoice($id){
        $TheOrder = Order::findOrFail($id);
        //Generate Invoice if There is not one Already
        $TheInvoice = Invoice::where('order_id' , $TheOrder->id)->first();
        if(!$TheInvoice){
            $TheInvoice = Invoice::create([
                'order_id' => $TheOrder->id,
                'user_id' => $TheOrder->user_id,
                'customer_name' => $TheOrder->first_name . ' ' . $TheOrder->last_name,
                'address' => $TheOrder->shipping_address,
                'city' => $TheOrder->shipping_city,
                'phone_number' => $TheOrder->phone_number,
                'email' => $TheOrder->email,
                'country' => $TheOrder->country,
                'vat_number' => $TheOrder->vat_number,
                'payment_method' => $TheOrder->payment_method,
                'order_serial_number' => $TheOrder->serial_number,
                'is_paid' => ($TheOrder->is_paid == 'paid') ? 1 : 0
            ]);
        }
        return view('admin.invoices.generate' , compact('TheOrder' , 'TheInvoice'));
    }

    public function postUpdate(Request $r , $id){
        //Validate the Request
        $Rules = [
            'invoice_prefix' => 'required',
            'customer_name' => 'required',
            'payment_method' => 'required',
            'created_at' => 'required',
            'order_serial_number' => 'required'
        ];
        if($r->id == $id){
            $Rules['id'] = 'required';
        }else{
            $Rules['id'] = 'required|unique:invoices';
        }
        $validator = Validator::make($r->all() , $Rules);
        if($validator->fails()){
            return back()->withErrors($validator->errors()->all());
        }else{
            //Grab the Invoice
            $TheInvoice = Invoice::findOrFail($id);
            $InvoiceData = $r->except('_token');
            $InvoiceData['customer_desc'] = nl2br($r->customer_desc);
            $InvoiceData['is_paid'] = 0;
            $InvoiceData['created_at'] = Carbon::create($r->created_at.date('H:i:s'));
            if($r->has('due_date')){
               $InvoiceData['due_date'] = Carbon::create($r->due_date.date('H:i:s'));
            }
            if($r->is_paid == 'on'){
               $InvoiceData['is_paid'] = 1;
            }
            $TheInvoice->update($InvoiceData);
            return back()->withSuccess('Invoice Data Updated');
        }
    }
    public function downloadInvoice($id){
        //Get Invoice Data
        $TheInvoice = Invoice::findOrFail($id);
        if($TheInvoice){
            $TheOrder = Order::findOrFail($TheInvoice->order_id);
        }
        $pdf = PDF::loadView('admin.invoices.download' , ['TheOrder' => $TheOrder , 'TheInvoice' => $TheInvoice]);
        return $pdf->download($TheOrder->serial_number.'.pdf');
        // return view('admin.invoices.download' , compact('TheInvoice' , 'TheOrder'));
    }
    public function sendToUser($id){
        //Get Invoice Data
        $TheInvoice = Invoice::findOrFail($id);
        if($TheInvoice){
            $TheOrder = Order::findOrFail($TheInvoice->order_id);
           $EmailData = Order::findOrFail($TheInvoice->order_id);
        }
        $pdf = PDF::loadView('admin.invoices.download' , ['TheOrder' => $TheOrder , 'TheInvoice' => $TheInvoice]);
        Mail::to($TheOrder->email)->send(new OrderInvoiceMail($EmailData,$pdf->output()));
        if (Mail::failures()) {
          return redirect()->route('invoice.generate.get', $TheOrder->id)->withSuccess("Sending Mail Failed");
        }else{
          return redirect()->route('invoice.generate.get', $TheOrder->id)->withSuccess("Invoice Has Been Mailed to ".$TheOrder->email);
        }
    }
}
