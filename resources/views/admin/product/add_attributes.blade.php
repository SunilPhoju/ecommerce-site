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
                @if (session('status'))
                  <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                  </div>
                @endif
                  <form action="{{url('add-attribute/'.$productDetails->id) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                    <input type="hidden" name="product_id" value="{{$productDetails->id}}">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Product name</label>
                        <label for="recipient-name" class="col-form-label"><strong>{{$productDetails->product_name}}</strong></label>
                          
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Product code</label>
                        <label for="recipient-name" class="col-form-label"><strong>{{$productDetails->product_code}}</strong></label>

                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Color</label>
                        <label for="recipient-name" class="col-form-label"><strong>{{$productDetails->product_color}}</strong></label>
                      </div> 
                      <div class="from-group">
                        <div class="field_wrapper">
                          <div>
                            <input type="text" name="sku[]" id="sku" placeholder="SKU" style="width:120px;" required/>

                            <input type="text" name="color[]" id="color" placeholder="color" style="width:120px;" required/>
                            <input type="text" name="price[]" id="price" placeholder="price" style="width:120px;" required/>

                            <input type="text" name="stock[]" id="stock" placeholder="stock" style="width:120px;" required />

                            <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                          </div>
                        </div>
                      </div>   
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Add Attribute</button>
                    </div>
                  </form>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <form action="{{url('edit-attribute/'.$productDetails->id) }}" method="POST">
                  {{ csrf_field() }}
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Attribute ID
                      </th>  
                      <th>
                        SKU
                      </th> 
                      <th>
                      Color
                      </th>
                      <th>
                        Price
                      </th>
                      <th>
                        Stock
                      </th>
                      <th>
                        Update
                      </th>
                      <th>
                        DELETE
                      </th>
                    </thead>
                    <tbody>
      
                      @foreach ($productDetails['attributes'] as $at)
                        <tr>
                          <td>
                          <input type="hidden" name = "idAttr[]" value="{{ $at->id }}">
                          {{$at->id}}
                          </td>
                          <td>
                            {{$at->sku}}
                          </td>
                          
                          <td>
                          {{$at->color}}
                          </td>
                          <td>
                            <input type="text" name="price[]" value="{{$at->price}}"> 
                          </td>
                          <td>
                            <input type="text" name="stock[]" value="{{$at->stock}}">
                          </td>
                          <!-- <td>
                              <a href="/editimage/{{$at->id}}" class="btn btn-success">EDIT</a>
                            </td>
                          -->
                          <td>
                            <input type="submit" value="Update" class="btn btn-primary">
                          </td>
                          <td class="center">
                            <form action="{{url('delete-attribute/'.$at->id)}}" method="post">
                              {{csrf_field()}}
                              
                              <button class="btn btn-danger btn-mini">DELETE</button>
                            </form>
                          </td>
                          
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection