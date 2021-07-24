<?php

namespace App\Http\Controllers;

use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\File;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = customer::get();
        // dd($data);
        return view('customer.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:customer',
            'address' => 'required',
            'file_upload' => 'required'
        ],
        [
            'name.required' => 'Ten khach hang khong dc de trong',
            'name.unique'   => 'Ten khach hang khong duoc trung',
            'address.required'=> 'ten address khong duoc de trong',
            'file_upload.required' => 'file_upload khong dc de trong'

            
        ]);
        if($request->has('file_upload')){
            $file = $request->file_upload;
            // $ext = $request->file_upload->extension();
            // $file_name = time().'-'.'product.'.$ext;
            // $file->move(public_path('uploads'),$file_name);
            // $request->merge(['image' => $file_name]);
            $path = $file->store('images', 'public');
            $request->merge(['image' => $path]);
            // $task->image = $path;
        }
            customer::create($request->only('name','address','image'));
            return redirect()->route('customer.index')->with('success','them thanh cong');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(customer $customer)
    {
        return view('customer.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, customer $customer)
    {
        $request->validate([
            'name' => 'required|unique:customer,name,'.$customer->id,
            'address' => 'required',
            'file_upload' => 'required',
        ],
        [
            'name.required' => 'Ten khach hang khong dc de trong',
            'name.unique'   => 'Ten khach hang khong duoc trung',
            'address.required'=> 'ten address khong duoc de trong',
            'file_upload.required' => 'file_upload khong dc de trong'

        ]);
        // if($request->has('file_upload')){
        //     $file = $request->file_upload;
        //     $ext = $request->file_upload->extension();
        //     $file_name = time().'-'.'product.'.$ext;
        //     $file->move(public_path('uploads'),$file_name);
        //     $request->merge(['image' => $file_name]);
        // }
        $image = $customer->image;
        Storage::delete('/public/' . $image);
        $file = $request->file_upload;
        $path = $file->store('images', 'public');
        $request->merge(['image' => $path]);
        $customer->update($request->only('name','address','image'));
        return redirect()->route('customer.index')->with('success','sua thanh cong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(customer $customer)
    {
        $image = $customer->image;
        Storage::delete('/public/' . $image);
         $customer->delete();
        return redirect()->route('customer.index')->with('success','xoa thanh cong');
    }
}
