<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{UserQuries, Footer, Seo, ContactUs, Type, Home_Hading, Home_Info, Home_Offer, Home_Features, Size, Happy_Customer,Term};
use Session;

class WebAdminController extends Controller
{
    public function Contact(){
        $contact = ContactUs::where('id',1)->first();
        return view('admin.pages.contact.edit', compact('contact'));
    }
    
    public function UserQuries(Request $request){
        try{
            if($request->ajax()){
                $data = UserQuries::orderby('id','DESC')->get();
                return \DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }
            else{
                return view('admin.pages.user_quries.index');
            }
        }
        catch(\Exception $e){
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    public function General (){
        $footer = Footer::first();
        return view('/admin/general/edit', compact('footer'));
    }
    
    public function PostFooter(Request $request){
        try{
            $data = $request->except('_token');
    
            if (isset($data['id'])) {
                // Image upload__________________
                if ($request->hasFile('image')) {
                    $logo = $request->file('image');
                    $name = $logo->getClientOriginalName();
                    $logo->move(public_path('frontend/assets/images/logo'), $name);
                    $data['image'] ='public/frontend/assets/images/logo/' . $name; 
                }
                
                // Update footer_________________
                Footer::find($data['id'])->update($data);
                
                Session::flash('success', 'Successfully updated footer details!');
                return redirect('/admin/general');
            }
            else {
                Session::flash('error', 'Invalid data provided for update.');
                return redirect()->back();
            }
        }
        catch(\Exception $e){
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    public function PostContactUs(Request $request){
        try{
            $data = $request->all();
            unset($data['_token']);
            unset($data['id']);
            unset($data['title']);
            unset($data['keyword']);
            unset($data['description']);
            // if($request->file('image')){
            //     $name = $request->file('image')->getClientOriginalName();
            //     $request->file('image')->move(public_path('frontend/assets/images/'), $name);
            //     $data['image'] = url('public/'.'frontend/assets/images/'.$name);
            // }
            
            // if($request->file('background_image')){
            //     $name = $request->file('background_image')->getClientOriginalName();
            //     $request->file('background_image')->move(public_path('frontend/assets/images/'), $name);
            //     $data['background_image'] = url('public/'.'frontend/assets/images/'.$name);
            // }
            $latitude = $data['latitude'];
            $longitude = $data['longitude'];
            $data['map'] = '<iframe width="1450" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
src="https://www.openstreetmap.org/export/embed.html?bbox=' . $longitude . '%2C' . $latitude . '%2C' . $longitude . '%2C' . $latitude . '&amp;layer=mapnik&amp;marker=' . $latitude . '%2C' . $longitude . '" style="border: 1px solid black"></iframe>';
            // dd($data);
            ContactUs::where('id',$request->get('id'))->update($data);
            
            Seo::where('type','LIKE','contact_page')->update([
                'title' => $request->title,
                'keyword' => $request->keyword,
                'description' => $request->description
            ]);
            
            Session::flash('success','Successfully updated contact_us details!');
            return redirect('/admin/contact');
        }
        catch(\Exception $e){
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    public function Type(Request $request){
        try {
            
            if ($request->ajax()) {
                $data = Type::orderby('id', 'DESC')->get();

                return \DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('Actions', function ($data) {
                        $btn = '<a href="'. url('admin/edit_type', $data->id ) .'" class="btn btn-sm btn-success">edit</a>';
                        $btn .= ' <a href="javascript:void(0)" data-id="' . $data->id . '" class="delete-queries btn btn-sm btn-danger">Delete</a>';
                        return $btn;
                    })
                    ->rawColumns(['Actions'])
                    ->make(true);
            } else {
                return view('admin.types.index');
            }
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect('/');
        }
    }
    
    public function AddType(){
        return view('admin.types.add');
    }
    
    public function PostType(Request $request){
        try{
            $data = $request->all();
            unset($data['_token']);
            
            // dd($data);
            Type::create($data);
            Session::flash('success','Successfully added Type details!');
            return redirect('/admin/type');
        }
        catch(\Exception $e){
            dd($e->getMessage());
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    public function EditType($id){
        $data = Type::find($id);
        return view('admin.types.edit', compact('data'));
    }
    
    public function UpdateType(Request $request, $id){
        try{
            $data = $request->all();
            unset($data['_token']);
            
            Type::find($id)->update($data);
            Session::flash('success','Successfully updated Type details!');
            return redirect('/admin/type');
        }
        catch(\Exception $e){
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    public function DeleteType($id){
        try{
            $header = Type::find($id)->delete();
        }
        catch(\Exception $e){
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    public function HomeHeader(){
        $headings = Home_Hading::orderBy('id','asc')->get();
        $info = Home_Info::where('id',1)->first();
        $offer = Home_Offer::where('id',1)->first();
        $featur1 = Home_Features::where('id',1)->first();
        $featur2 = Home_Features::where('id',2)->first();
        $featur3 = Home_Features::where('id',3)->first();
        $featur4 = Home_Features::where('id',4)->first();
        $seo = Seo::where('type','LIKE','home_page')->first();
        
        return view('admin.pages.home.edit', compact('headings','info','offer','featur1','featur2','featur3','featur4','seo'));
    }
    
    public function UpdateHeading(Request $request, $id){
        try{
            $data = $request->all();
            unset($data['_token']);
            if($id == 3){ 
                // dd($data, $id);
                Home_Hading::find($id)->update([
                    'heading' => $request->heading,
                    'product_id' => $request->selected_id
                    ]);
            } else {
                if($id == 3 || $id == 1){
                    $product_ids = implode(',', $data['product_id']);
                    $data['product_id'] = $product_ids;
                    
                    Home_Hading::find($id)->update($data);
                }else{
                    Home_Hading::find($id)->update($data);
                }
            }
            Session::flash('success','Successfully updated Heading details!');
            return redirect('/admin/home_header');
        }
        catch(\Exception $e){
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    public function UpdateInfo(Request $request, $id){
        try{
            $data = $request->all();
            unset($data['_token']);
            
            if($request->file('image')){
                $name = $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('frontend/assets/images/img'), $name);
                $data['image'] = 'public/frontend/assets/images/img/'.$name;
            }
            Home_Info::find($id)->update($data);
            Session::flash('success','Successfully updated Info details!');
            return redirect('/admin/home_header');
        }
        catch(\Exception $e){
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    public function UpdateOffer(Request $request){
        try{
            $data = $request->all();
            unset($data['_token']);
                
            if($request->file('image')){
                $name = $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('frontend/assets/images/logo'), $name);
                $data['image'] = 'public/frontend/assets/images/logo/'.$name;
            }
            Home_Offer::where('id',$request->get('id'))->update($data);
            
            Session::flash('success','Successfully updated Offer details!');
            return redirect()->back();
        }
        catch(\Exception $e){
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    public function UpdateFeature(Request $request){
        try{
            $data = $request->all();
            unset($data['_token']);
                
            if($request->file('image')){
                $name = $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('frontend/assets/images/img'), $name);
                $data['image'] = 'public/frontend/assets/images/img/'.$name;
            }
            Home_Features::where('id',$request->get('id'))->update($data);
            
            Session::flash('success','Successfully updated Feature details!');
            return redirect()->back();
        }
        catch(\Exception $e){
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    public function UpdateSeo(Request $request){
        try{
            $data = $request->all();
            unset($data['_token']);
                
            
            Seo::where('type',$request->get('type'))->update($data);
            
            Session::flash('success','Successfully updated Seo details!');
            return redirect()->back();
        }
        catch(\Exception $e){
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    public function Size(Request $request){
        try {
            
            if ($request->ajax()) {
                $data = Size::orderby('id', 'DESC')->get();

                return \DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('Actions', function ($data) {
                        $btn = ' <a href="javascript:void(0)" data-id="' . $data->id . '" class="delete-queries btn btn-sm btn-danger">Delete</a>';
                        return $btn;
                    })
                    ->rawColumns(['Actions'])
                    ->make(true);
            } else {
                return view('admin.sizes.index');
            }
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect('/');
        }
    }
    
    public function AddSize(){
        return view('admin.sizes.add');
    }
    
    public function PostSize(Request $request){
        try{
            $data = $request->all();
            unset($data['_token']);
            
            // dd($data);
            Size::create($data);
            Session::flash('success','Successfully added Size details!');
            return redirect('/admin/size');
        }
        catch(\Exception $e){
            dd($e->getMessage());
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    public function DeleteSize($id){
        try{
            $header = Size::find($id)->delete();
        }
        catch(\Exception $e){
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    public function HappyCustomer(Request $request){
        try {
            
            if ($request->ajax()) {
                $data = Happy_Customer::orderby('id', 'DESC')->get();

                return \DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('Actions', function ($data) {
                        $btn = '<a href="'. url('admin/edit_customer', $data->id ) .'" class="btn btn-sm btn-success">edit</a>';
                        $btn .= ' <a href="javascript:void(0)" data-id="' . $data->id . '" class="delete-queries btn btn-sm btn-danger">Delete</a>';
                        return $btn;
                    })
                    ->rawColumns(['Actions'])
                    ->make(true);
            } else {
                return view('admin.pages.happy_customer.index');
            }
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return redirect('/');
        }
    }
    
    public function AddCustomer(){
        return view('admin.pages.happy_customer.add');
    }
    
    public function PostCustomer(Request $request){
        try{
            $data = $request->all();
            unset($data['_token']);
            if($request->file('image')){
                $name = $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('frontend/assets/images/img'), $name);
                $data['image'] = 'public/frontend/assets/images/img/'.$name;
            }
            // dd($data);
            Happy_Customer::create($data);
            Session::flash('success','Successfully added Happy Customer details!');
            return redirect('/admin/happy_customer');
        }
        catch(\Exception $e){
            dd($e->getMessage());
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    public function EditCustomer($id){
        $data = Happy_Customer::find($id);
        return view('admin.pages.happy_customer.edit', compact('data'));
    }
    
    public function UpdateCustomer(Request $request, $id){
        try{
            $data = $request->all();
            unset($data['_token']);
            
            if($request->file('image')){
                $name = $request->file('image')->getClientOriginalName();
                $request->file('image')->move(public_path('frontend/assets/images/img'), $name);
                $data['image'] = 'public/frontend/assets/images/img/'.$name;
            }
            // dd($data);
            Happy_Customer::find($id)->update($data);
            Session::flash('success','Successfully updated Happy Customer details!');
            return redirect('/admin/happy_customer');
        }
        catch(\Exception $e){
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    public function DeleteCustomer($id){
        try{
            $header = Happy_Customer::find($id)->delete();
        }
        catch(\Exception $e){
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
    // Terms___________________________________________________________________
    public function terms(Request $request){
        $terms = Term::where('id',1)->first();
        $seo = Seo::where('type','LIKE','terms_page')->first();
        return view('admin.pages.terms.edit', compact('terms','seo'));
    }
    
    public function terms_post(Request $request){
        try{
            $data = $request->all();
            unset($data['_token']);
            unset($data['seo_title']);
            unset($data['seo_keyword']);
            unset($data['seo_description']);
            // dd($data);
            Term::where('id',1)->update($data);
            
            Seo::where('type','LIKE','terms_page')->update([
                'title' => $request->seo_title,
                'keyword' => $request->seo_keyword,
                'description' => $request->seo_description
            ]);
            
            Session::flash('success','Successfully updated terms & conditions details!');
            return redirect()->back();
        }
        catch(\Exception $e){
            Session::flash('error', $e->getMessage()); 
            return redirect()->back();
        }
    }
    
}
