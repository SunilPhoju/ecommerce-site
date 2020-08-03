@extends('layouts.master')

@section('title')
Products |
@endsection


@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD Products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/products" enctype="multipart/form-data" method="POST">
        {{ csrf_field() }}
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
            <input type="text" name="product_name" class="form-control" id="recipient-name" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Product code</label>
            <input type="text" name="product_code" class="form-control" id="recipient-name" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Color</label>
            <input type="text" name="product_color" class="form-control" id="recipient-name" required>
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Description</label>
            <input type="text" name="description" class="form-control" id="recipient-name" required>
          </div>
          <div class="row">
            <label for="image" class="col-form-label">Image</label>
            <input type="file" name="image" class="form-control" id="image">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Price</label>
            <input type="text" name="price" class="form-control" id="recipient-name" required>
          </div>
        </div>

        <div class="modal-footer">
          <button class="btn btn-primary">ADD</button>
        </div>

      </form>
    </div>
  </div>
</div>



<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Products
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">ADD</button>
          </h4>
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          @if (session('stat'))
            <div class="alert alert-danger" role="alert">
              {{ session('stat') }}
            </div>
          @endif
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table">
              <thead class=" text-primary">
                <th>
                  Id
                </th>
                <th>
                  Category ID
                </th>
                
                <th>
                 Name
                </th>
                <th>
                  Code
                </th>
                <th>
                  Color
                </th>
                <th>
                  Description
                </th>
                <th>
                  Price
                </th>
                <th>
                  Image
                </th>
                <th>
                    Action
                </th>
                
              </thead>
              <tbody>

                @foreach ($product as $pd)
                <tr>
                  <td>
                    {{$pd->id}}
                  </td>
                  <td>
                   {{$pd->category_id}}
                  </td>
                  <td>
                   {{$pd->product_name}}
                  </td>
                  <td>
                    {{$pd->product_code}}
                  </td>
                  <td>
                    {{$pd->product_color}}
                  </td>
                  <td>
                    {{$pd->description}}
                  </td>
                  <td>
                    {{$pd->price}}
                  </td>
                  <td>
                    <img src="{{ asset('uploads/products/'. $pd->image)}}" width="100px" height="100px" alt="image">
                  </td>
                   
                  <td>
                    <a href="/editimage/{{$pd->id}}" class="btn btn-success btn-mini">EDIT</a>
                    <form action="{{url('delete-product/'.$pd->id)}}" method="post">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                      <button class="btn btn-danger btn-mini">DELETE</button>
                    </form>
                    <a href="{{url('add-attribute/'.$pd->id) }}" class="btn btn-success btn-mini" title="Add Atrribute">ADD</a>
                    <a href="{{url('add-images/'.$pd->id) }}" class="btn btn-info btn-mini" title="Add Images">ADD</a>

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


@section('scripts')
    
@endsection