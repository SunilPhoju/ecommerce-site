@extends('layouts.master')

@section('title')
Product Edit |
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Product-Edit</h4>

        <form action="{{url('product-edit/'.$product->id)}}" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{method_field('PUT')}}
          <div class="modal-body">

            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Under Category</label>
                <div class="control">
                  <select name="category_id" class="form-control">
                    <?php echo $categories_dropdown; ?>
                  </select>
                </div>
            </div>

            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Product name</label>
              <input type="text" name="product_name" class="form-control" value="{{$product->product_name}}">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Product code</label>
              <input type="text" name="product_code" class="form-control" value="{{$product->product_code}}" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Color</label>
              <input type="text" name="product_color" class="form-control" value="{{$product->product_color}}" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Description</label>
              <input type="text" name="description" class="form-control" value="{{$product->description}}">
            </div>         
            <div class="form-group">
              <label for="message-text" class="col-form-label">Price</label>
              <textarea class="form-control" name="price">{{$product->price}}</textarea>
            </div>
            <div class="row">
              <label for="image" class="col-form-label">Image</label>
              <input type="file" name="image" class="form-control" value="{{$product->image}}" id="image">
            </div>
          </div>  
          <div class="modal-footer">
            <a href="{{url('products')}}"class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
           
        </form>
      </div>
    </div>
  </div>
</div>
@endsection