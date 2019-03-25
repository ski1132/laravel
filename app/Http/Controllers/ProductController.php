<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use Input,Config, Validator,image;
use Illuminate\Http\Request;
use Auth;
class ProductController extends Controller
{
    var $rp;
    public function __construct(){
        $this->rp = Config::get('app.result_per_page');
    }
    public function index(){
        $products = Product::paginate($this->rp);
        return view('product/index', compact('products'));
    }
    public function search(){
        $query = Input::get('q');
        if($query){
            $products = Product::where('code','like','%'.$query.'%')  //เป็นคำสั่งที่ค้นหา where() ถ้ามีอีกก็ต่อด้วย ->orWhere()
                ->orWhere('name','like','%'.$query.'%')
                ->paginate($this->rp);
        }
        else{
            $products = Product::paginate($this->rp);
        }
        return view('product/index',compact('products'));
    }
    public function edit($id = null)
    {
        $categories = Category::pluck('name','id') ->prepend('เลือกรายการ','');
        if($id)
        {

        
        $product = Product ::where('id',$id)->first();
        return view('product/edit')
            ->with('product',$product)
            ->with('categories',$categories);
        }
        else
        {
            return view('product/add')
                ->with('categories',$categories);
        }
    }
    public function update()
    {
        $rules = array(
            'code' => 'required',
            'name' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'numeric',
            'stock_qty' => 'numeric',
        );
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน',
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        );
        $id = Input::get('id');

        $validator = Validator::make(Input::all(), $rules, $messages);
        if($validator->fails())
        {
            return redirect('product/edit/'.$id)
            ->withErrors($validator)
            ->withInput();
        }
        $product = Product::find($id);
        $product->code = Input::get('code');
        $product->name = Input::get('name');
        $product->category_id = Input::get('category_id');
        $product->price = Input::get('price');
        $product->stock_qty = Input::get('stock_qty');
        
        if(Input::hasFile('image'))
        {
            $f = Input::file('image');
            $upload_to = 'upload/images';
            //get Path
            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;
            // upload file ส่งเข้าไปใน folder
            $f->move($absolute_path,$f->getClientOriginalName());
            //save image path to db
            $product->image_url = $relative_path;
        }
        $product->save();
        return redirect('product')
        ->with('ok', true)
        ->with('msg' , 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }// end function update
    public function insert()
    {
        $rules = array(
            'code' => 'required',
            'name' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'numeric',
            'stock_qty' => 'numeric',
        );
        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน',
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        );

        $validator = Validator::make(Input::all(), $rules, $messages);
        if($validator->fails())
        {
            return redirect('product/add')
            ->withErrors($validator)
            ->withInput();
        }
        $product = new Product();
        $product->code = Input::get('code');
        $product->name = Input::get('name');
        $product->category_id = Input::get('category_id');
        $product->price = Input::get('price');
        $product->stock_qty = Input::get('stock_qty');
        
        if(Input::hasFile('image'))
        {
            $f = Input::file('image');
            $upload_to = 'upload/images';
            //get Path
            $relative_path = $upload_to.'/'.$f->getClientOriginalName();
            $absolute_path = public_path().'/'.$upload_to;
            // upload file ส่งเข้าไปใน folder
            $f->move($absolute_path,$f->getClientOriginalName());
            //save image path to db
            $product->image_url = $relative_path;
            //Image::make(public_path().'/'.$relative_path)->resize(250,250)->save();
        }
        $product->save();
        return redirect('product')
        ->with('ok', true)
        ->with('msg' , 'บันทึกข้อมูลเรียบร้อยแล้ว')
        ;
    }
    public function remove($id)
    {
        Product::find($id)->delete();

        return redirect('product')
            ->with('ok',true)
            ->with('msg','ลบข้อมูลสำเร็จ');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
