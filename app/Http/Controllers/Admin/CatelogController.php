<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CatelogController extends Controller
{
   public function GetSize(Request $request)
   {
       $input =$request->all();
        
       $selectedValues = $input['selectedValues'];
       $count= count($selectedValues);
        $size = \DB::table('sizes')->whereIn('id', $selectedValues)->get();
        // dd($size);

        $DynamicData = [];
         for($i=0; $i < $count; $i++)
         {
            $DynamicData[]="<tr><td>". $size[$i]->name ."</td>
            <input type='hidden' class='form-control' name ='size_id[]' value=".$size[$i]->id." placeholder='Price'>
            <td><input type='number' class='form-control' name ='price[]' placeholder='Price'></td>
               <td><input type='number' class='form-control' name ='discounted[]' placeholder='Discounted Price'></td>
               <td><input type='number' class='form-control' name ='quantity[]' placeholder='Total Quantity'></td></tr>";
            
            
         }
         return response()->json(['status' => true , 'DynamicData' =>$DynamicData]);
   }
}
