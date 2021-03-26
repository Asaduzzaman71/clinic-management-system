<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use App\Models\User;
use App\Models\InvoiceEntry;
use App\Http\Requests\InvoiceRequest;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Cart;
use Session;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $this->authorize('viewAny',Invoice::class);
      $invoices=Invoice::paginate(10);
      return view('invoice.index',compact('invoices'));
       
    }

    public function create()
    {
        $this->authorize('create',Invoice::class);
        return view('invoice.create');
    }

    public function store(InvoiceRequest $request)
    {
        $this->authorize('create',Invoice::class);
        $validatedData = $request->validated();
       // dd($validatedData);
        $numberOfEntries=count($request->amount);
        $subtotal=0.0;
        for($i=0;$i<$numberOfEntries;$i++){
            $subtotal=$subtotal+$request->amount[$i]*$request->quantity[$i];
            
        }
        $vat = ($subtotal * $request->vat) / 100;
        $total = $subtotal + $vat - $request->discount;
        $invoice_number = IdGenerator::generate(['table' => 'invoices', 'field' => 'invoice_number','reset_on_prefix_change' =>true,'length' => 6, 'prefix' => date('ym')]);
        $invoice=new Invoice();
        $invoice->title=$request->title;
        $invoice->patient_id=$request->patientId;
        $invoice->invoice_number=$invoice_number;
        $invoice->vat=$request->vat;
        $invoice->discount=$request->discount;
        $invoice->subtotal=$subtotal;
        $invoice->total=$total;
        $invoice->status=$request->status;
        $invoice->created_by=Auth()->user()->id;
        $invoice->updated_by=NULL;
        $invoice->save();
       // $invoice=Invoice::where('invoice_number',$invoice_number);
        //dd($invoices);
       
        for($i=0;$i<$numberOfEntries;$i++){
            $invoiceEntry=new InvoiceEntry();
            $invoiceEntry->invoice_number=$invoice_number;
            $invoiceEntry->entry=$request->entry[$i]; 
            $invoiceEntry->amount=$request->amount[$i];
            $invoiceEntry->quantity=$request->quantity[$i];
            $invoiceEntry->subtotal=$request->quantity[$i]*$request->amount[$i];
            $invoiceEntry->created_by=Auth()->user()->id;
            $invoiceEntry->updated_by=NULL;
            $invoiceEntry->save();
        }
      //  $invoiceEntries=InvoiceEntry::where('invoice_number',$invoice_number);
        return redirect()->route('invoices.index');
    }
    

   
    public function show($invoiceNumber)
    {   
        $invoice=Invoice::Where('invoice_number',$invoiceNumber)->first();
        $this->authorize('view',$invoice); 
        $user=User::Where('id',$invoice->created_by)->first();
        $invoiceEntries=InvoiceEntry::Where('invoice_number',$invoiceNumber)->get();
        return view('invoice.invoice',compact('invoiceEntries','invoice','user'));
    }

    public function edit($invoiceNumber)
    {
        $invoice=Invoice::Where('invoice_number',$invoiceNumber)->first();
        $this->authorize('update',$invoiceNumber);
       
        $invoice=Invoice::Where('invoice_number',$invoiceNumber)->first();
        $invoiceEntries=InvoiceEntry::Where('invoice_number',$invoiceNumber)->get();
        return view('invoice.edit',compact('invoice','invoiceEntries'));
    }

  
    public function update(InvoiceRequest $request,$invoiceNumber)
    {
        $invoice=Invoice::Where('invoice_number',$invoiceNumber)->first();
        $this->authorize('update',$invoiceNumber);
        $validatedData = $request->validated();
        $numberOfEntries=count($request->invoiceEntryId);
        $subtotal=0.0;
        for($i=0;$i<$numberOfEntries;$i++){
            $subtotal=$subtotal+$request->amount[$i]*$request->quantity[$i];
            
        }
        $vat = ($subtotal * $request->vat) / 100;
        $total = $subtotal + $vat - $request->discount;
      
        $invoice=Invoice::Where('invoice_number',$invoiceNumber)->first();
        $invoice->title=$request->title;
        $invoice->patient_id=$request->patientId;
        $invoice->invoice_number=$request->invoiceId;
        $invoice->vat=$request->vat;
        $invoice->discount=$request->discount;
        $invoice->subtotal=$subtotal;
        $invoice->total=$total;
        $invoice->status=$request->status;
        $invoice->created_by=$invoice->created_by;
        $invoice->updated_by=Auth()->user()->id;
        $invoice->save();
       // $invoice=Invoice::where('invoice_number',$invoice_number);
        //dd($invoices);
       
        for($i=0;$i<$numberOfEntries;$i++){
            $invoiceEntry=InvoiceEntry::findOrFail($request->invoiceEntryId[$i]);
            $invoiceEntry->invoice_number=$invoiceNumber;
            $invoiceEntry->entry=$request->entry[$i]; 
            $invoiceEntry->amount=$request->amount[$i];
            $invoiceEntry->quantity=$request->quantity[$i];
            $invoiceEntry->subtotal=$request->quantity[$i]*$request->amount[$i];
            $invoiceEntry->created_by=$invoiceEntry->created_by;
            $invoiceEntry->updated_by=Auth()->user()->id;
            $invoiceEntry->save();
        }
      //  $invoiceEntries=InvoiceEntry::where('invoice_number',$invoice_number);
        return redirect()->route('invoices.index');
       
    }

    
    public function destroy($invoiceNumber)
    {
        //dd($invoiceNumber);
        $invoice=Invoice::Where('invoice_number',$invoiceNumber)->first();
        $this->authorize('delete',$invoice);
        $invoice->delete();
        $invoiceEntries=InvoiceEntry::Where('invoice_number',$invoiceNumber);
        $invoiceEntries->delete();
        
    }

    public function invoiceEntryAdd(Request $request){
     
        $cartData = array();
        $cartData['qty'] = 1;
        $cartData['id'] = rand(1,1000);
        $cartData['name'] = $request->invoiceEntry;
        $cartData['price'] = $request->amount;
        $cartData['weight'] = 0;
        Cart::add($cartData);

      
        return redirect()->route('invoices.create');

    }
    public function invoiceEntrydelete($rowId)
    {
        Cart::remove($rowId);
        return redirect()->route('invoices.create');
    }
    public function saveInvoice(Request $request)
    {

        $vat = $request->vat;
        $discount = $request->discount;


        $items = Cart::content();

        $invoice_number = IdGenerator::generate(['table' => 'invoices', 'field' => 'invoice_number','reset_on_prefix_change' =>true,'length' => 6, 'prefix' => date('ym')]);


        //insert data into invoice table
        $invoice = new Invoice();
        $invoice->invoice_number = $invoice_number;
        $invoice->user_id = Auth::user()->id;
        $invoice->invoice_time = date("h:i:sa");
        $invoice->discount = $discount;
        $invoice->vat = $vat;
        $invoice->created_by = Auth::user()->user_name;
        $invoice->updated_by = NULL;


        //dd($items);
        foreach ($items as $item) {

            $cost_price = 0.0;
            $selling_price = 0.0;
            $medicine_name = $item->name; //invoice medicne name
            $medicine_quantity = $item->qty; //invoice medicine quantity
            $medicine = Medicine::where('medicine_name', '=', $medicine_name)->first();

            //medicine quantity after creating invoice
            $latest_medicine_quantity = $medicine->quantity - $medicine_quantity;

            Medicine::where('medicine_name', 'LIKE', $medicine_name) //update medicine quantity
            ->update(['quantity' => $latest_medicine_quantity]);


            //calculating profit
            $cost_price = $cost_price + ($medicine->purchase_price * $medicine_quantity);
            $selling_price = $selling_price + ($medicine->selling_price * $medicine_quantity);
            $profit_amount = $selling_price - $cost_price;

            //insert data into sales items table
            $salesitem = new Salesitem();
            $salesitem->invoice_number = $invoice_number;
            $salesitem->medicine_id = $item->id;
            $salesitem->medicine_quantity = $item->qty;
            $salesitem->medicine_price_rate = $item->price;
            $salesitem->profit_amount = $profit_amount;
            $salesitem->created_by = Auth::user()->user_name;
            $salesitem->updated_by = NULL;
            $salesitem->save();
        }

        //dd($i);

        // subtotal and grandtotal
        $time = now()->format("j M y, g:i a");

        $subtotal = Cart::subtotal(2, '.', '');
        $total_vat = ($subtotal * $vat) / 100;
        $grand_total = $subtotal + $total_vat - $discount;
        $invoice->subtotal = $subtotal;
        $invoice->grand_total = $grand_total;

        $invoice->save();

        Cart::destroy();

        return view('pages.point_of_sale.invoice', compact('items','time','invoice_number','subtotal', 'grand_total', 'vat', 'discount', 'total_vat'));
    }

}
