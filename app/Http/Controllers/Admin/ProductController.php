<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, ProductDetail, Grind, Size, Order};
use Session;
use Cviebrock\EloquentSluggable\Services\SlugService;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::orderby('id', 'DESC')->get();
            foreach ($data as $img){
                $img->image = url('/').'/'.$img->image ;
            }

            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('Actions', function ($data) {
                    $btn = '<a href="'. route('products.edit', $data->id ) .'" class="btn btn-sm btn-success">edit</a>';
                    $btn .= ' <a href="javascript:void(0)" data-id="' . $data->id . '" class="delete-queries btn btn-sm btn-danger">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['Actions'])
                ->make(true);
        }else{
        
            return view('admin.products.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sizes = \DB::table('sizes')->select('*')->get();
        $grinds = \DB::table('grinds')->select('*')->get();
        $types = \DB::table('types')->select('*')->get();
        return view('admin.products.add', compact('sizes', 'grinds', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(empty($request->size_id)){
            return redirect()->back()->with('error', 'Select Size field');
        }

        //Primary Image_______________________________________________
        $primary_Image = str_replace(' ','',$request->file('image')->getClientOriginalName());
        $request->file('image')->move(public_path('assets/products/primary_images'), $primary_Image);


        /**_______________Secondary Images_______________ */
        $secondaryImagesPaths = [];
        if ($request->hasFile('secondary_images')) {
            foreach ($request->file('secondary_images') as $secondaryImage) {
                $image = str_replace(' ', '', $secondaryImage->getClientOriginalName());
                $secondaryImage->move(public_path('secondary_images'), $image);
                $secondaryImagesPaths[] = "public/secondary_images/$image";
            }
        }
        $price = array(
            'name' => $request->name,
            'slug'=> SlugService::createSlug(Product::class, 'slug', $request->name),
            'description' => $request->description,
            'image' => 'public/assets/products/primary_images/'.$primary_Image,
            'grind_id'=>$request->grind_id,
            'product_type'=>$request->product_type,
            'currency'=>'$',
            'status' => '1',
            'secondary_images'=>json_encode($secondaryImagesPaths),
        );
        $product = \DB::table('products')->insertGetId($price);
        
        
       
        /**_______________Product Details Data_______________ */
            for($v=0; $v <count($request->size_id); $v++){
                $pricedetails = array(
                    'product_id' => $product,
                    'price' => $request->price[$v],
                    'discounted' => $request->discounted[$v],
                    'size_id' => $request->size_id[$v],
                    'quantity' => $request->quantity[$v]
                );
                ProductDetail::insert($pricedetails);
            }
        
        // ******************   END - CREATE PRODUCT    ******************    //


        Session::flash('success', 'Product added successfully');
        return redirect('/admin/products');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::join('grinds', 'products.grind_id', 'grinds.id')
        ->select('products.*', 'grinds.name as grind_name')
        ->where('products.id',$id)->first();
        $product_detail = \DB::table('product_details')
        ->join('sizes', 'product_details.size_id', '=', 'sizes.id')
        ->select('product_details.*', 'sizes.name')
        ->where('product_id',$id)->orderBy('id','DESC')
        ->get();
        $count = count( $product_detail);
        $price_detail = \DB::table('product_details')->where('product_id',$id)->first();
       
      

 

       
        $sizes = Size::orderby('id','DESC')->get();
        $product->secondary_images =json_decode($product->secondary_images);
        $grinds = \DB::table('grinds')->select('*')->get();
        $types = \DB::table('types')->select('*')->get();

        // dd($product );
 
        return view('admin.products.edit',compact('product','product_detail','sizes', 'grinds', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(empty($request->size_id)){
            return redirect()->back()->with('error', 'Select Size field');
        }
    //  dd($request->all());
        
        // ******************    UPDATE PRODUCT    ******************    //
        $price = array(
            'name' => $request->name,
            'description' => $request->description,
            'grind_id'=>$request->grind_id,
            'product_type'=>$request->product_type,

        );
        
        //Primary Image_______________________________________________
        if(!empty($request->file('image'))){
            $primary_Image = str_replace(' ','',$request->file('image')->getClientOriginalName());
            $request->file('image')->move(public_path('assets/products/primary_images'), $primary_Image);
            $price['image'] = 'public/assets/products/primary_images/'.$primary_Image; 
        }

         /**_______________Secondary Images_______________ */
         $secondaryImagesPaths = [];
         if ($request->hasFile('secondary_images')) {
             foreach ($request->file('secondary_images') as $secondaryImage) {
                 $image = str_replace(' ', '', $secondaryImage->getClientOriginalName());
                 $secondaryImage->move(public_path('secondary_images'), $image);
                 $secondaryImagesPaths[] = "public/secondary_images/$image";
                 $price['secondary_images'] =json_encode($secondaryImagesPaths);
             }
         }
        
        $product = Product::find($id);
        $product->update($price);
        
        
            ProductDetail::where('product_id',$id)->delete();

            for($v=0; $v < count($request->size_id); $v++){
                $pricedetails = array(
                    'product_id' => $id,
                    'price' => $request->price[$v],
                    'discounted' => $request->discounted[$v],
                    'size_id' => $request->size_id[$v],
                    'quantity' => $request->quantity[$v]
                );
                
                ProductDetail::insert($pricedetails);
              }
            
        

        
        Session::flash('success', 'Product updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::where('id',$id)->delete();
        ProductDetail::where('product_id',$id)->delete(); 
        return response()->json(['success' => true]);
    }
    
    
    
    
    
    /* --------------------- ORDERS --------------------- */
    
    public function orders(Request $request)
    {
        if ($request->ajax()) {
            // $data = Order::leftjoin('user_address','orders.user_id','=','user_address.user_id')
            //             ->select('orders.*','user_address.shipping_name','user_address.shipping_email')
            //             ->orderby('orders.id', 'DESC')->get();
            
            $data = Order::leftjoin('user_address','orders.user_id','=','user_address.user_id')
                            ->selectRaw('MAX(orders.id) as id, orders.order_id, user_address.shipping_name, user_address.shipping_email')
                            ->groupBy('orders.order_id', 'user_address.shipping_name', 'user_address.shipping_email')
                            ->orderBy('id', 'DESC')
                            ->get();
            
            return \DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('Actions', function ($data) {
                    $btn = '<a href="'. url('/admin/orders', $data->id ) .'" class="btn btn-sm btn-success">View</a>';
                    // $btn .= ' <a href="javascript:void(0)" data-id="' . $data->id . '" class="delete- btn btn-sm btn-danger">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['Actions'])
                ->make(true);
        }else{
        
            return view('admin.orders.index');
        }
    }
    
    public function orders_view(Request $request, $id){
        $data = Order::find($id);
        $payment = Order::where('order_id','LIKE',$data->order_id)->get();
        
        $amount = 0;
        foreach($payment as $pay){
            $price = $pay->total * $pay->quantity;
            $amount = $amount + $price;
        }
        
        return view('admin.orders.view',compact('data','payment','amount'));
    }
    
    public function orders_post(Request $request){
        try{
            $data = $request->only('order_status');
            
            if($data['order_status'] == "5"){
                $getorders = \DB::table('orders')
                    ->join('users','orders.user_id','=','users.id')
                    ->join('products','orders.product_id','=','products.id')
                    ->select('orders.*','users.*','products.name as product_name','products.image as product_image')
                    ->where('orders.order_id',$request->order_id)
                    ->first();
                    
                $getorders->body = "User order has been canceled by Admin.";
                // dd($getorders);
                $orders = Order::where('order_id','LIKE',$request->order_id)->get();
                
                foreach($orders as $order){
                    
                    $order->update($data);
                }
                // dd($orders->email);
                $mail = \Mail::send('email.cancel_mail', ['getorders' => $getorders], function ($message) use ($getorders) {
                    $message->to($getorders->email)->subject('Order canceled');
                });
                
                return redirect()->back()->with('success','Successfully updated order status');
            }else{
                $orders = Order::where('order_id','LIKE',$request->order_id)->get();
                foreach($orders as $order){
                    $order->update($data);
                }
                
                return redirect()->back()->with('success','Successfully updated order status');
            }
        }
        catch(\Exception $e){
            dd($e->getMessage());
        }
    }
    /* --------------------- END - ORDERS --------------------- */
}
