@extends('layout.index')
@section('main')
<form action="{{route('customer.store')}}" method="POST" enctype="multipart/form-data">
            <legend>Form title</legend>
            @csrf
            <div class="form-group">
                <label for="">name</label>
                <input type="text" name="name" class="form-control" id="" placeholder="Input field">
                @error('name')
                    <small class="help-block">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="">address</label>
                <input type="text" name="address" class="form-control" id="" placeholder="Input field">
                @error('address')
                 <small class="help-block">{{$message}}</small>
                 @enderror
            </div>
            <div class="form-group">
                <label for="">image</label>
                <input type="file" name="file_upload" class="form-control" id="" placeholder="Input field">
                @error('file_upload')
                 <small class="help-block">{{$message}}</small>
                 @enderror
            </div>
        
            
        
            <button type="submit" class="btn btn-primary">Submit</button>
            <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Hủy</button>
        </form>
@stop()