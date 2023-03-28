@extends('layouts.master')
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Blog Category All</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">Blog Category All Data </h4>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Blog Category Name</th>
                                    <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach($categories as $item)
                                <tr>
                                    <td> {{ ++$i}} </td>
                                    <td> {{ $item->category_name }} </td>

                                    <td>
                                        <form action="{{ route('categories.destroy',$item->id) }}" method="POST">
                                            <a href="{{ route('categories.edit',$item->id) }}" class="btn btn-info sm" title="Edit Data"> <i class="fas fa-edit"></i> </a>
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{$categories->links()}}
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
    </div> <!-- container-fluid -->
</div>


@endsection