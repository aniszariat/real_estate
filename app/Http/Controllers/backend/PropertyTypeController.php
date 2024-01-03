<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    function AllType()
    {
        $types = PropertyType::latest()->get();
        return view('backend.type.all_type', compact('types'));
    }    // end method
    function AddType()
    {
        return view('backend.type.add_type');
    }    // end method
    function StoreType(Request $request)
    {
        // validation 
        $request->validate([
            "type_name" => 'required|unique:property_types|max:200',
            "type_icon" => 'required'
        ]);
        PropertyType::insert([
            "type_name" => $request->type_name,
            "type_icon" => $request->type_icon
        ]);


        $notification = array(
            'message' => 'Type created successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('all.type')->with($notification);
    }    // end method

}
