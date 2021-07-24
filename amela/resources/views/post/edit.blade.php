@extends('layout.index')
@section('main')
<h1><a href="{{URL::to('post')}}">quay lai</a></h1>
<form action="{{route('post.update',$post->id)}}" method="POST" role="form">
    @csrf
    <legend>Form title</legend>

    <div class="form-group">
        <label for="">title</label>
        <input type="text" name="title" class="form-control" id="" placeholder="Input field">
        @error('title')
                    <small class="help-block">{{$message}}</small>
                @enderror
    </div>
    <div class="form-group">
        <label for="">content</label>
        <textarea name="content" id="summernote" cols="30" rows="10"></textarea>
        @error('content')
                    <small class="help-block">{{$message}}</small>
                @enderror
    </div>
    <div class="form-group">
        <label for="">category_id</label>
        <input type="text" name="category_id" class="form-control"  placeholder="Input field">
        @error('category_id')
                    <small class="help-block">{{$message}}</small>
                @enderror
    </div>
    <div class="form-group">
        <label for="">created_at</label>
        <input type="date" name="created_at" class="form-control" id="" placeholder="Input field">
        @error('created_at')
                    <small class="help-block">{{$message}}</small>
                @enderror
    </div>
    <div class="form-group">
        <label for="">updated_at</label>
        <input type="date" name="updated_at" class="form-control" id="" placeholder="Input field">
        @error('updated_at')
                    <small class="help-block">{{$message}}</small>
                @enderror
    </div>

    

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@stop()
@section('js')
<script src="{{URL::to('public')}}/plugins/summernote/summernote-bs4.min.js"></script>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    
    
  })
</script>
@stop()

@section('css')
<link rel="stylesheet" href="{{URL::to('public')}}/plugins/summernote/summernote-bs4.min.css">
@stop()