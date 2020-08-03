@extends('layouts.master')

@section('title')
Categories |
@endsection


@section('content')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD Categories</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>


      </div>

      <form action="/save-categories" method="POST">
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Category name</label>
            <input type="text" name="name" class="form-control" id="recipient-name" required>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Category levels</label>
            <div class="control">
              <select name="parent_id" class="form-control">
                <option value="0">Main Category</option>
                @foreach ($levels as $val)
                  <option value="{{$val->id}}">{{$val->name}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label">URL</label>
            <input type="text" name="url" class="form-control" id="recipient-name" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Description</label>
            <textarea class="form-control" name="description" id="message-text" required></textarea>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">ADD Category</button>
        </div>

      </form>
    </div>
  </div>
</div>



<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Categories
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">ADD</button>
          </h4>
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
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
                  Category Name
                </th>
                <th>
                  Category Levels
                </th>
                <th>
                 Description
                </th>
                <th>
                  URL
                </th>
                <th>
                    EDIT
                </th>
                <th>
                    DELETE
                </th>
              </thead>
              <tbody>

                @foreach ($category as $data)
                <tr>
                  <td>
                  {{$data->id}}
                  </td>
                  <td>
                    {{$data->name}}
                  </td>
                  <td>
                    {{$data->parent_id}}
                  </td>
                  <td>
                    {{$data->description}}
                  </td>           
                  <td>
                    {{$data->url}}
                  </td>
                  <td>
                  <a href="{{url('edit-category/'.$data->id)}}" class="btn btn-success">EDIT</a>
                  </td>
                  <td>

                  <form action="{{url('delete-category/'.$data->id)}}" method="post">
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


@section('scripts')
    
@endsection