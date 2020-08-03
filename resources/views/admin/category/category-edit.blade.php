@extends('layouts.master')

@section('title')
Category Edit |
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Category-Edit</h4>

            <form action="{{url('category-edit/'.$category->id)}}" method="POST">
                    {{ csrf_field() }}
                    {{method_field('PUT')}}
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Category name</label>
                      <input type="text" name="name" class="form-control" value="{{$category->name}}">
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Category Levels</label>
                        <div class="control">
                          <select name="parent_id" class="form-control">
                            <option value="0">Main Category</option>
                            @foreach ($levels as $val)
                              <option value="{{$val->id}}" @if($val->id == $category->parent_id)
                              selected @endif>{{$val->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Description</label>
                        <input type="text" name="description" class="form-control" value="{{$category->description}}">
                      </div>
                      <div class="form-group">
                        <label for="message-text" class="col-form-label">URL</label>
                        <textarea class="form-control" name="url">{{$category->url}}</textarea>
                      </div>
                    </div>
            
                    <div class="modal-footer">
                    <a href="{{url('categories')}}"class="btn btn-secondary">Back</a>
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
            
                  </form>

            </div>
        </div>
    </div>
</div>
@endsection