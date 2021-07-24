@extends('layout.index')
@section('main')
<h1><a href="{{URL::to('post/create')}}">them moi</a></h1>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>title</th>
            <th>content</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($posts as $post)
        <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->title}}</td>
            <td>{!!$post->content!!}</td>
            <td>{{$post->created_at}}</td>
            <td>{{$post->updated_at}}</td>
            <td>
            <a href="{{route('post.edit',$post->id)}}">edit</a>
            <!-- Button trigger modal -->
<!-- Button trigger modal -->

<a href="{{route('post.destroy', $post->id)}}" class="btn btn-sm btn-danger btndelete"  
    onclick="return confirm('Bạn chắc muốn xóa?')">delete</a>

    
    </td>
        </tr>
        @endforeach
    </tbody>
</table>

@stop()
