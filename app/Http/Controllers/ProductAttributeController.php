<?php

namespace App\Http\Controllers;

use App\Models\Product_Attribute;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            if(isset($request->per_page)){
                $per_page=$request->per_page;
            }else{
                $per_page=10;
            }
            $vender_id=1;
            return response()->json(['success'=>DB::table('product_attributes')->where('vender_id',$vender_id)->orderBy('id','DESC')->paginate($per_page)]);
        }catch(Exception $e){
            return response()->jsonp(['error'=>$e->getMessage()]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $validation=Validator($request->all(),[
                'name'=>'required'
            ]);
            if($validation->fails()){
                return response()->json(['validation'=>$validation->getMessageBag()]);
            }
            $data=$request->all();
            $data['vender_id']=1;
            $data['updated_by']=1;
            $attribute=DB::table('product_attributes')->insert($data);
            return response()->json(['success'=>'Attribute is inserted !!','data'=>$attribute]);
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product_Attribute  $product_Attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Product_Attribute $product_Attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product_Attribute  $product_Attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Product_Attribute $product_Attribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product_Attribute  $product_Attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $validation=Validator($request->all(),[
                'name'=>'required'
            ]);
            if($validation->fails()){
                return response()->json(['validation'=>$validation->getMessageBag()]);
            }
            $data['name']=$request->name;
            $data['vender_id']=1;
            $data['updated_by']=1;
            $attribute=DB::table('product_attributes')->where('id',$id)->update($data);
            return response()->json(['success'=>'Attribute is updated !!','data'=>true]);
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product_Attribute  $product_Attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::table('product_attributes')->where('id',$id)->delete();
            return response()->json(['success'=>'Attribute is deleted !!']);
        }catch(Exception $e){
            return response()->json(['error'=>$e->getMessage()]);
        }
    }
}
