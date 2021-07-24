@extends('layout.index')
@section('main')
<div class="container">
    <div class="col-12">
        <div class="row">
            <h1>Danh Sách Khách Hàng</h1>
            <a href="{{route('customer.create')}}">them moi</a>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Address</th>
                    <th scope="col">image</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(count($data) == 0)
                    <tr>
                        <td colspan="4">Không có dữ liệu</td>
                    </tr>
                @else
                    @foreach($data as $key => $customer)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->address }}</td>
                            <td><img src="storage/app/public/{{$customer->image}}" width="200px" alt=""></td>
                            <td>
                                <a href="{{route('customer.edit',$customer->id)}}">edit</a>
                                <!-- <form action="{{route('customer.destroy', $customer->id)}}" method="POST" id="form-delete" >
                               
                                    @csrf @method('DELETE')

                                <button type="submit" class="btn btn-primary">delete</button>

                                </form> -->
                                <a href="{{route('customer.destroy', $customer->id)}}" class="btn btn-sm btn-danger btndelete">delete</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<form action="" method="POST" id="form-delete" >
@csrf @method('DELETE')
</form>

@stop()
@section('js')
<script>
    $('.btndelete').click(function(ev){
        ev.preventDefault();
        var _href =$(this).attr('href');
        $('form#form-delete').attr('action',_href);
        if(confirm('bạn có muốn xóa không ?')){
            $('form#form-delete').submit();
        }
    })
</script>
@stop()