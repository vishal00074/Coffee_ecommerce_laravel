<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{UserQuries, Product, Rating, Term, Seo};
use Illuminate\Support\Facades\Auth;

class WebPagesController extends Controller
{
    public function contact_us(){
        return view('contactus');
    }
    
    public function blog(){
        return view('blog');
    }
    
    public function shop(){
        $products = Product::orderBy('id','desc')->get();
        foreach($products as $product){
            $product_detail = \DB::table('product_details')
                ->where('product_id', $product->id)
                ->select('price','discounted')
                ->orderBy('price','ASC')
                ->first();
                
            $product->price  = $product_detail->price; 
            $product->discounted_price  = $product_detail->discounted ;
        }
        // dd($products);
        return view('shop', compact('products'));
    }
    
    public function cart(){
        return view('cart');
    }
    
    public function UserQuries(Request $request){
        $input = $request->except('_token');
        if(!empty($input['name']) && !empty($input['email']) && !empty($input['subject']) && !empty($input['message'])){
                
            $admin = \DB::table('admins')->first();
            $detail['name'] = $request->get('name') ?? '';
            $detail['email'] = $request->get('email') ?? '';
            $detail['subject'] = $request->get('subject') ?? '';
            $detail['message'] = $request->get('message') ?? '';
            $detail['title'] = "Welcome to CBD COFFEE Web Application";
            $detail['body'] = "User raised a query to CBD Coffee Web Application.";
            // dd($detail);
            \Mail::send('email.user_queries', ['detail' => $detail], function ($message) use ($detail, $admin) {
                $message->to($admin->email)->subject($detail['title']);
            });
        
            UserQuries::create($input);
            return redirect()->back()->with('success', 'Your message sent to the administration');
        }
        else{
            return redirect()->back()->with('error', 'Please fill the necessary details');
        }
    }
    
    public function ProductDetail($slug){
        $products = Product::where('slug',$slug)->first();
        
            $product_detail = \DB::table('product_details')
                ->where('product_id', $products->id)
                ->select('price','discounted','quantity','size_id')
                ->first();
                
            $reviews = \DB::table('ratings')
            ->where('product_id', $products->id)
            ->select(\DB::raw('SUM(stars)/COUNT(user_id) as ratted'))
            ->pluck('ratted') 
            ->first();
            
            $rating_count =  \DB::table('ratings')
            ->where('product_id', $products->id)
            ->select(\DB::raw('COUNT(user_id) as count') )
            ->pluck('count')
            ->first(); 
            
            $products->rating = $reviews;
            $products->rating_count = $rating_count;
            $products->size_id  = $product_detail->size_id;   
            $products->price  = $product_detail->price; 
            $products->discounted_price  = $product_detail->discounted ;
            $products->quantity  = $product_detail->quantity ;
              $products->secondary_images =json_decode($products->secondary_images);
              
              
        $random_products = Product::orderBy('id','desc')->get();
        foreach($random_products as $product){
            $product_detail = \DB::table('product_details')
                ->where('product_id', $product->id)
                ->select('price','discounted')
                ->orderBy('price','ASC')
                ->first();
            
               
            $product->price  = $product_detail->price; 
            $product->discounted_price  = $product_detail->discounted ;
        }
        // dd($products);
        return view('shop_details', compact('products', 'random_products'));
    }
    
    public function RateProduct(Request $request){
        try{   
            $id = Auth::id();
            $data = $request->all();
            unset($data['_token']);
            $data['user_id'] = $id;
            // dd($data);
            Rating::insert($data);
            return redirect("/profile")->with('success','Succesfully submit rating.');
        }
        catch(\Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
    
    public function TypeProduct(Request $request){
        // dd($request->all());
        $type_id = $request->id ;
        if($type_id){
            $query = \DB::table('products')
                ->select('products.*');
            
            if (!empty($type_id)) {
                $query->where('product_type', $type_id);
            } 
            
            $products = $query->get();
            foreach($products as $product){
                $products_detail = \DB::table('product_details')
                    ->where('product_id', $product->id)
                    ->select('price','discounted')
                    ->first();
                    
                $product->price = $products_detail->price;
                $product->discounted_price = $products_detail->discounted;
            }
        }else{
            $query = \DB::table('products')
                ->select('products.*')
                ->orderBy('id','asc');
            $products = $query->get();
            foreach($products as $product){
                $products_detail = \DB::table('product_details')
                    ->where('product_id', $product->id)
                    ->select('price','discounted')
                    ->first();
                    
                $product->price = $products_detail->price;
                $product->discounted_price = $products_detail->discounted;
            }
        }
        // dd($products);
        return response()->json(['products' => $products]);
    }
    
    public function Terms(){
        $term = Term::where('id', 1)->first();
        $seo = Seo::where('type','LIKE','terms_page')->first();
        
        return view('term', compact('term', 'seo'));
    }
}
