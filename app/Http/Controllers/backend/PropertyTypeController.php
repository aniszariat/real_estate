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
    public function EditType($id)
    {
        $types = PropertyType::findOrfail($id);
        return view('backend.type.add_type', compact('types'));
    }    // end method
    public function UpdateType(Request $request)
    {
        $types = PropertyType::findOrfail($request->id)->update([
            "type_name" => $request->type_name,
            "type_icon" => $request->type_icon
        ]);

        $notification = array(
            'message' => 'Type Upadted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.type')->with($notification);
    }    // end method

    public function DeleteType($id)
    {
        $types = PropertyType::findOrfail($id)->delete();

        $notification = array(
            'message' => 'Type deleted successfully!',
            'alert-type' => 'warning'
        );

        return redirect()->route('all.type')->with($notification);
    }    // end method




}
