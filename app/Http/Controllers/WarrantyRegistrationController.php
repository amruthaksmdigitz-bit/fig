<?php
namespace App\Http\Controllers;

use App\Models\WarrantyRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\WarrantyRegisteredMail;
use Illuminate\Support\Facades\Log;   
use App\Models\Product;
use App\Models\Variation;



class WarrantyRegistrationController extends Controller
{
    // --- Frontend Form ---
    public function frontendCreate()  
    {
         $user = auth()->user();
if (!$user) {
    // User is not logged in, redirect or abort
    return redirect('/login'); // or abort(403, 'Unauthorized');
}
    // Only allow specific emails
            if (!in_array($user->email, ['iamshafimc@gmail.com','dealer@veloguardx.com', 'admin@veloguardx.com'])) {
                abort(403, 'Unauthorized'); // or redirect('/login');
            }
		$products=Product::all();
        return view('warranty.register',compact('products'));
    }

    public function frontendStore(Request $request)
    {
         $user = auth()->user();
if (!$user) {
    // User is not logged in, redirect or abort
    return redirect('/login'); // or abort(403, 'Unauthorized');
}
    // Only allow specific emails
            if (!in_array($user->email, ['iamshafimc@gmail.com','dealer@veloguardx.com', 'admin@veloguardx.com'])) {
                abort(403, 'Unauthorized'); // or redirect('/login');
            }
        $request->validate([
		    'product_id'     => 'required',
            'serial_number' => 'required',
            'dealer_name' => 'required',
            'area' => 'required',
            'body_parts' => 'required',
            'email' => 'required',
            
            'phone_number'  => 'required',
            'vehicle_number'=> 'required',
            'address'       => 'required',
            'expiry_date'   => 'required|date',
            'customer_name'       => 'required|string|max:255',
    'dealer_name'         => 'required|string|max:255',
    'dealer_phone_number' => 'nullable|string|max:20',
        ]);

        $warranty = WarrantyRegistration::create($request->all());

            if ($warranty) {
                 try {
        Mail::to($request->email)->send(new WarrantyRegisteredMail($warranty));

        return redirect()->route('warranty.show', $warranty->id)
                         ->with('success', 'Warranty registered successfully and mail sent.');
    } catch (\Exception $e) {
        Log::error('Mail not sent: '.$e->getMessage());

        return redirect()->route('warranty.show', $warranty->id)
                         ->with('warning', 'Warranty registered, but mail failed.');
    }
            } else {
                return back()->with('error', 'Failed to save warranty. Please try again.');
            }


        return redirect()->route('warranty.frontend.create')->with('success', 'Warranty registered successfully!');
    }

    // --- Frontend Search ---
      public function view($id)
{

     $user = auth()->user();
if (!$user) {
    // User is not logged in, redirect or abort
    return redirect('/login'); // or abort(403, 'Unauthorized');
}
    // Only allow specific emails
            if (!in_array($user->email, ['iamshafimc@gmail.com','dealer@veloguardx.com', 'admin@veloguardx.com'])) {
                abort(403, 'Unauthorized'); // or redirect('/login');
            }

   $warranty = WarrantyRegistration::findOrFail($id);

    return view('warranty.view',compact('warranty'));

}
  public function searchForm(Request $request)
{
    $results = collect(); // empty by default 
            $searched = false;

            if ($request->serial_number || $request->phone_number || $request->vehicle_number || $request->barcode) {
                $searched = true;

                     $query = \App\Models\WarrantyRegistration::with('product', 'product.variations');
       
           
           if ($request->serial_number) {
            $query->where('serial_number', 'like', "%{$request->serial_number}%")
                  ->whereHas('product.variations', function ($v) use ($request) {
                      $v->where('serial_number', 'like', "%{$request->serial_number}%");
                  });
        }      
             if ($request->phone_number) {
            $query->where('phone_number', 'like', "%{$request->phone_number}%");
        }

        if ($request->vehicle_number) {
            $query->where('vehicle_number', 'like', "%{$request->vehicle_number}%");
        }

        if ($request->barcode) {
            $query->whereHas('product', function ($p) use ($request) {
                $p->where('barcode', 'like', "%{$request->barcode}%");
            });
        }

                $results = $query->get();
            }

    return view('warranty.search', compact('results', 'searched'));
}

public function renewal(Request $request)
{

     $user = auth()->user();
if (!$user) {
    // User is not logged in, redirect or abort
    return redirect('/login'); // or abort(403, 'Unauthorized');
}
    // Only allow specific emails
            if (!in_array($user->email, ['iamshafimc@gmail.com','dealer@veloguardx.com', 'admin@veloguardx.com'])) {
                abort(403, 'Unauthorized'); // or redirect('/login');
            }
    $results = collect(); // empty by default
    $searched = false;

       if ($request->serial_number || $request->phone_number || $request->vehicle_number || $request->barcode) {
                $searched = true;

                     $query = \App\Models\WarrantyRegistration::with('product', 'product.variations');
       
           
           if ($request->serial_number) {
            $query->where('serial_number', 'like', "%{$request->serial_number}%")
                  ->whereHas('product.variations', function ($v) use ($request) {
                      $v->where('serial_number', 'like', "%{$request->serial_number}%");
                  });
        }      
             if ($request->phone_number) {
            $query->where('phone_number', 'like', "%{$request->phone_number}%");
        }

        if ($request->vehicle_number) {
            $query->where('vehicle_number', 'like', "%{$request->vehicle_number}%");
        }

        if ($request->barcode) {
            $query->whereHas('product', function ($p) use ($request) {
                $p->where('barcode', 'like', "%{$request->barcode}%");
            });
        }

                $results = $query->get();
            }

    return view('warranty.renewal', compact('results', 'searched'));
}


    public function extendSubmit(Request $request, $id)
    {

         $user = auth()->user();
          if (!$user) {
    // User is not logged in, redirect or abort
    return redirect('/login'); // or abort(403, 'Unauthorized');
}
    // Only allow specific emails
            if (!in_array($user->email, ['iamshafimc@gmail.com','dealer@veloguardx.com', 'admin@veloguardx.com'])) {
                abort(403, 'Unauthorized'); // or redirect('/login');
            }
        $request->validate([
            'warranty_reg_upto' => 'required|date',
        ]);

        $warranty = WarrantyRegistration::findOrFail($id);
        $warranty->warranty_reg_upto = $request->warranty_reg_upto;
        $warranty->save();

        return redirect()->route('warranty.renewal')->with('success', 'Warranty extended successfully!');
    }

   

    // --- Backend CRUD ---
    public function index()
    {
        $warranties = WarrantyRegistration::latest()->paginate(10);
        return view('backend.warranties.index', compact('warranties'));
    }

    public function create()
    {
        return view('backend.warranties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'serial_number' => 'required',
            'phone_number'  => 'required',
            'vehicle_number'=> 'required',
            'address'       => 'required',
            'expiry_date'   => 'required|date',
        ]);

        WarrantyRegistration::create($request->all());
        return redirect()->route('warranty-registrations.index')->with('success', 'Created successfully');
    }

    public function edit(WarrantyRegistration $warrantyRegistration)
    {
        return view('backend.warranties.edit', compact('warrantyRegistration'));
    }

    public function update(Request $request, WarrantyRegistration $warrantyRegistration)
    {
        $request->validate([
            'serial_number' => 'required',
            'phone_number'  => 'required',
            'vehicle_number'=> 'required',
            'address'       => 'required',
            'expiry_date'   => 'required|date',
        ]);

        $warrantyRegistration->update($request->all());
        return redirect()->route('warranty-registrations.index')->with('success', 'Updated successfully');
    }

    public function destroy(WarrantyRegistration $warrantyRegistration)
    {
        $warrantyRegistration->delete();
        return redirect()->route('warranty-registrations.index')->with('success', 'Deleted successfully');
    }
    

public function sendTestMail()
{
    try {
        Mail::raw('This is a test message from Laravel.', function ($message) {
            $message->to('faihadeveloper@gmail.com')
                    ->subject('Laravel Test Mail');
        });

        return response()->json([
            'status' => 'success',
            'message' => '✅ Mail dispatch attempted. Check inbox or logs.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => '❌ Mail failed: ' . $e->getMessage()
        ]);
    }
}
 
}
