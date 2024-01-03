@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">

    <nav class="page-breadcrumb">
        <a href="{{route('add.type')}}" class="btn btn-inverse-success">Add Property Type</a>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Data Table</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>TYPE NAME</th>
                                    <th>TYPE ICON</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($types as $key =>$item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->type_name }}</td>
                                    <td>{{ $item->type_icon }}</td>
                                    <td>
                                        <a href="" class="btn btn-inverse-warning">Edit</a>
                                        <a href="" class="btn btn-inverse-danger">Delete</a>
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

</div>

@endsection