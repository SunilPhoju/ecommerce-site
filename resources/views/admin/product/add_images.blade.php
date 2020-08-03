@extends('layouts.master')

@section('title')
Product Edit |
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Products Images</h4>
                @if (session('status'))
                  <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                  </div>
                @endif
                  <form action="{{url('add-images/'.$productDetails->id) }}" method="POST" enctype="multipart/form-data">
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
                      <div class="row">
                        <label for="image" class="col-form-label">Image</label>
                        <input type="file" name="image[]" class="form-control" id="image" multiple ="multiple" required>
                      </div>
                       
                        
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Add Images</button>
                    </div>
                  </form>

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                    <thead class=" text-primary">
                        <th>
                            Image ID
                        </th>   
                        <th>
                            Product ID
                        </th>
                        <th>
                            Images
                        </th>
                        <th>
                            Action
                        </th>
                    </thead>
                    <tbody>
                        @foreach ($productsImages as $image)
                            <tr>
                                <td>
                                    {{$image->id}}
                                </td>
                                <td>
                                    {{$image->product_id}}
                                </td>
                                <td>
                                    {{$image->image}}
                                </td>
                                <td>
                                    <img src="{{ asset('uploads/alternativeimages/'. $image->image)}}" width="100px" height="60px" alt="image">
                                </td>
                                <td>
                                    <form action="{{url('delete-images/'.$image->id)}}" method="post">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection