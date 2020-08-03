<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;

use App\Models\Categories;
use App\Models\Products;
use App\Models\ProductsAttribute;
use App\Models\ProductsImage;
use App\Models\Country;
use App\Models\DeliveryAddresses;
use App\User;
use App\Models\Rating;

use Auth;
use Session;
use Image;
use DB;
use App\Http\Controllers\Controller;



class ProductsController extends Controller
{
    public function add_Product(Request $request)
    {
        $product = Products::all();
        if($request->isMethod('post'))
        {
            //$data = $request->all();

            if(empty($request->input('category_id'))){
                 return redirect()->back()->with('stat','category id is missing');

            }

            $product = new Products;
            $product->category_id = $request->input('category_id');
            $product->product_name = $request->input('product_name');
            $product->product_code = $request->input('product_code');
            $product->product_color = $request->input('product_color');

            if(!empty($request->input('description'))){
                $product->description = $request->input('description');
            }
            else{
                $product->description = '';
            }

            $product->price = $request->input('price');

            //upload image
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
               // if($image_temp->isValid()){
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
              //  $large_image_path = 'image/products/large/'.$filename;
               // $medium_image_path = 'image/products/medium/'.$filename;
               // $small_image_path = 'image/products/small/'.$filename;
                    //Resize images

               // Image::make($file)->save($large_image_path);
                //Image::make($file)->resize(600,600)->save($medium_image_path);
                //Image::make($file)->resize(300,300)->save($small_image_path);

                    //store image name in products table
                $file->move('uploads/products/',$filename);
                $product->image = $filename;

            }
            else{
                return $request;
                $product->image = '';
            }

            $product->save();
            return redirect()->back()->with('status','Product added successfully');
        }
            
        
         //categories drop down star
        $categories = Categories::where(['parent_id'=>'0'])->get();
        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach($categories as $cat)
        {
            $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
            $sub_categories = Categories::where(['parent_id'=>$cat->id])->get();
            foreach($sub_categories as $sub_cat)
            {
                $categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";

            }
        }
        //ends here
        
        return view('/admin.products')->with('product',$product)->with(compact('categories_dropdown'));

    }

    public function edit($id){
        $product = Products::findOrFail($id);
         //categories drop down star
        $categories = Categories::where(['parent_id'=>'0'])->get();
        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach($categories as $cat)
        { 
            if($cat->id==$product->category_id){
                 $selected = "selected";

            }
            else{
                 $selected ="";
            }
            $categories_dropdown .= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
            $sub_categories = Categories::where(['parent_id'=>$cat->id])->get();
            foreach($sub_categories as $sub_cat)
            {
                if($sub_cat->id==$product->category_id){
                    $selected = "selected";
   
                }
                else{
                    $selected ="";
                }
                 $categories_dropdown .= "<option value='".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
 
            }
        }

        return view('admin.product.product-edit')->with('product',$product)->with(compact('product','categories_dropdown'));
        
    }

    public function update(Request $request, $id){
        $product = Products::findOrFail($id);
        $product->category_id=  $request->input('category_id');
        $product->product_name = $request->input('product_name');
        $product->product_code = $request->input('product_code');
        $product->product_color = $request->input('product_color');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        //image update
        if ($request->hasfile('image')){
            $file = $request->file('image');
               // if($image_temp->isValid()){
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/products/',$filename);
            $product->image = $filename;
        }
        else{
            return $request;
            $product->image = '';
        }
        $product->update();


        


        return redirect('products')->with('status','Product updated succesfully');
    }

    public function delete($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();
        return redirect('products')->with('status','Product deleted');
    }
    ///adding product attribute
    public function addAtrributes(Request $request,$id){
        $productDetails = Products::with('attributes')->where(['id'=>$id])->first();
       // $productDetails = json_decode(json_encode($productDetails));
        //echo "<pre>"; print_r($productDetails); die;
        if($request->isMethod('post')){
            $data = $request->all();

            foreach($data['color'] as $key =>$val){
                if(!empty($val)){
                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->color = $val;
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->sku = $data['sku'][$key];


                    $attribute->save();

                }
            }

            return redirect('add-attribute/'.$id)->with('status','Product attribute added successfully');
           
            
        }
        return view('admin.product.add_attributes')->with(compact('productDetails'));
    }
    //edit product attribute
    public function editAtrributes(Request $request,$id){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            foreach($data['idAttr'] as $key => $attr){
                ProductsAttribute::where(['id'=>$data['idAttr'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);

            }
        return redirect()->back()->with('status','Product attribute updated successfully');
        }
    }
    //delete products attribute
    public function deleteattribute($id = null){
        ProductsAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('status','Product attribute deleted successfully');
    }
    //add alternative images
    public function addImages(Request $request,$id=null){
        $productDetails = Products::with('attributes')->where(['id'=>$id])->first();
       
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            if($request->hasFile('image')){
                $files = $request->file('image');
                foreach($files as $file){
                   
                    //echo "<pre>"; print_r($files); die;
                    $image = new ProductsImage;
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;

                    $file->move('uploads/alternativeimages',$filename);
                    $image->image = $filename;
                    $image->product_id = $data['product_id'];
                    $image->save();
                }
            }
            return redirect('add-images/'.$id)->with('status', 'Images added');
            
            
        }
        $productsImages = ProductsImage::where(['product_id'=>$id])->get();

        return view('admin.product.add_images')->with(compact('productDetails','productsImages'));
    }
    //delete alternative images
    public function deleteImages($id = null){
        ProductsImage::where(['id'=>$id])->delete();
        
        return redirect()->back()->with('status','Product image deleted');
    }
   

    public function products($url= null)
    {
        //show 404 page if category url doesnot exist
        $countCategory = Categories::where(['url'=>$url])->count();
        if($countCategory==0){
            abort(404);
        }

        //get all categories and sub categories
        $categories = Categories::with('categories')->where(['parent_id'=>'0'])->get();

        $categoryDetails = Categories::where(['url'=>$url])->first();

        if($categoryDetails->parent_id=='0'){
            //if url is Maincategory url
            $subCategories = Categories::where(['parent_id'=>$categoryDetails->id])->get();

            foreach($subCategories as $subcat){
                $cat_ids[]= $subcat->id;
            }
          
            $productsAll = Products::whereIn('category_id',$cat_ids)->get();
           // $productsAll = json_decode(json_encode($productsAll));
           // echo "<pre>"; print_r($productsAll); die;
        }
        else{
            //if url is subcategory url
            $productsAll = Products::where(['category_id'=> $categoryDetails->id])->get();

        }
        

        return view('product.listing')->with(compact('categories','categoryDetails','productsAll'));
    }
    
    public function product($id = null){

        $productDetails = Products::with('attributes', 'ratings')->where(['id'=>$id])->first();
       // $productDetails = json_decode(json_encode($productDetails));
       // echo "<pre>"; print_r($productDetails); die;
        //get all categories and sub categories
        $categories = Categories::with('categories')->where(['parent_id'=>'0'])->get();

        //get alternatives images
        $productAltImages = ProductsImage::where('product_id',$id)->get();
        //$productAltImages = json_decode(json_encode($productAltImages));
       // echo "<pre>"; print_r($productAltImages); die;
        $total_stock = ProductsAttribute::where('product_id',$id)->sum('stock');

        return view('product.detail')->with(compact('productDetails','categories','productAltImages','total_stock'));
    }

    public function getProductPrice(Request $request){
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        $proArr = explode("-",$data['idColor']);
        //echo $proArr[0]; echo $proArr[1]; die;
        $proAttr = ProductsAttribute::where(['product_id' => $proArr[0], 'color' =>$proArr[1]])->first();
        echo $proAttr->price;
        echo "#";
        echo $proAttr->stock;
        echo $proAttr->sku;

    }
    //addto cart
    public function addtocart(Request $request){
        $data =$request->all();
        //echo "<pre>"; print_r($data); die;
        if(empty($data['user_email'])){
            $data['user_email'] = '';

        }
        $session_id = Session::get('session_id');

        if(empty($session_id)){
            $session_id = str_random(30); 
            Session::put('session_id',$session_id);
        }

        $colorArr = explode("-",$data['color']);

        $countProduct = DB::table('cart')->where(['product_id'=>$data['product_id'],
                        'product_color'=>$colorArr[1],
                        'session_id'=>$session_id])->count();
        
        if($countProduct>0){
            return redirect()->back()->with('status','Product already exists in Cart!');
        }else{

            $getSKU = ProductsAttribute::select('sku')->where(['product_id'=>$data['product_id'],'color'=>$colorArr[1]])->first();

            DB::table('cart')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],
            'product_code'=>$getSKU->sku,'price'=>$data['price'],'product_color'=>$colorArr[1],'user_email'=>$data['user_email'],
            'session_id'=>$session_id,
            'quantity'=>$data['quantity']
            ]);
        }

        
        return redirect('cart')->with('status','Product added to cart!');
    }
    //cart page controller
    public function cart(){
        $session_id = Session::get('session_id');
        $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        foreach($userCart as $key => $product){
            //echo $product->product_id;
            $productDetails = Products::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
       // echo "<pre>"; print_r($userCart); die;
        return view('product.cart')->with(compact('userCart'));
    }
    //delete cart item
    public function deletecart($id = null){
        DB::table('cart')->where('id',$id)->delete();
        return redirect('cart')->with('status','product has been removed from cart!');
    }

    //increase or decrese quantity
    public function updateCartQuantity($id = null,$quantity= null){
        $getCartDetails = DB::table('cart')->where('id',$id)->first();
        $getAtrributeStock = ProductsAttribute::where('sku',$getCartDetails->product_code)->first();

       // echo $getAtrributeStock->stock; echo"--";
        $updated_quantiy = $getCartDetails->quantity+$quantity;
        if($getAtrributeStock->stock >= $updated_quantiy){
            DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
            return redirect('cart')->with('status','product quantity has been updated successfully!');

        }else{
            return redirect('cart')->with('stat','product quantity is not available!');

        }

        
    }

    //checkout function
    public function checkout(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::find($user_id);
        $countries = Country::get();
        //check if shipping address exists
        $shippingCount = DeliveryAddresses::where('user_id',$user_id)->count();
        $shippingDetails = array();
        if($shippingCount>0){
            $shippingDetails = DeliveryAddresses::where('user_id',$user_id)->first();
        }
        //update cart table with user email
        $session_id = Session::get('session_id');
        DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);

        




        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data);die;

            if(empty($data['billing_name']) || empty($data['billing_address']) || empty($data['billing_address'])
                || empty($data['billing_city']) || empty($data['billing_state']) 
                || empty($data['billing_country']) || empty($data['billing_pincode']) || empty($data['billing_mobile']) || empty($data['shipping_name'])
                || empty($data['shipping_address']) || empty($data['shipping_city']) || empty($data['shipping_state']) || empty($data['shipping_country'])
                || empty($data['shipping_pincode']) || empty($data['shipping_mobile'])){
                    return redirect()->back()->with('err','Please Fill all fields to checkout!');
            }

            //update user details
            User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],
                'city'=>$data['billing_city'],'state'=>$data['billing_state'],'country'=>$data['billing_country'],
                'pincode'=>$data['billing_pincode'],'phone'=>$data['billing_mobile']]);
            
            if($shippingCount>0){

                DeliveryAddresses::where('user_id',$user_id)->update(['name'=>$data['shipping_name'],'address'=>$data['shipping_address'],
                'city'=>$data['shipping_city'],'state'=>$data['shipping_state'],'country'=>$data['shipping_country'],
                'pincode'=>$data['shipping_pincode'],'phone'=>$data['shipping_mobile']]);
                $shipping = DeliveryAddresses::where('user_id',$user_id)->first();
            }else{
                $shipping = new DeliveryAddresses;
                $shipping->user_id = $user_id;
                
                $shipping->user_email = $user_email;
                $shipping->name = $data['shipping_name'];
                $shipping->address = $data['shipping_address'];
                $shipping->city = $data['shipping_city'];
                $shipping->state = $data['shipping_state'];
                $shipping->country = $data['shipping_country'];
                $shipping->pincode = $data['shipping_pincode'];
                $shipping->phone = $data['shipping_mobile'];
                $shipping->save();
            }



            $cart_products = DB::table('cart')->where(['session_id'=>$session_id])->get();
        foreach($cart_products as $cart_product)
        {
            DB::table('order')->insert([
               'product_id' => $cart_product->product_id,
               'product_name'   =>  $cart_product->product_name,
               'product_code'   =>  $cart_product->product_code,
               'product_color'   =>  $cart_product->product_color,


               'product_name'   =>  $cart_product->product_name,
               'price' => $cart_product->price, 
               'quantity'   =>  $cart_product->quantity,
               'delivery_id'   =>  $shipping->id,


            ]);
            DB::table('cart')->where(['session_id'=>$session_id])->delete();
        }
            
            return redirect('/order-review');

        }

        return view('users.checkout')->with(compact('userDetails','countries','shippingDetails'));
    }
    //Review function
    public function orderReview()
    {
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::where('id',$user_id)->first();
        $shippingDetails = DeliveryAddresses::where('user_id',$user_id)->first();
        $shippingDetails = json_decode(json_encode($shippingDetails));

        $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
        foreach($userCart as $key => $product){
            //echo $product->product_id;
            $productDetails = Products::where('id',$product->product_id)->first();
            $userCart[$key]->image = $productDetails->image;
        }
        
       
        return view('product.order_review')->with(compact('userDetails','shippingDetails','userCart'));
    }

    //review to each product
    public function review(Request $request, $id){
        // Rating::create([
        //     'user_id'   =>  \Auth::user()->id,
        //     'product_id'    =>  $id,
        //     'rating'        =>  $request->rating,
        //     'title'         =>  $request->title,
        //     'description'   =>  $request->comment,
        //     'email'         =>  $request->email
        // ]);



        $rating = new Rating;
        $rating->user_id = \Auth::user()->id;
        $rating->product_id = $id;
        $rating->description = $request->comment;
        $rating->title = $request->title;
        $rating->email = $request->email;
        $rating->rating = $request->rating;
        $rating->save();



        return redirect()->back();
    }

    public function search(){
        

        //get all categories and sub categories
        $categories = Categories::with('categories')->where(['parent_id'=>'0'])->get();
        
        $productsAll = Products::where('product_name', 'LIKE', '%'.@$_GET['keyword'].'%')->paginate(12);
   
        

        return view('product.search')->with(compact('categories','productsAll'));
    }
}
