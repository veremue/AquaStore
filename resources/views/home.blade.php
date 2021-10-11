@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>{{ __('Aquariums') }}</span>
                    <span class="float-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            Add
                        </button>
                    </span>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <table class="table table-hover table-striped" id="datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Glass type</th>
                                    <th>Size</th>
                                    <th>Shape</th>
                                    <th>Fish Count</th>
                                    <th>Creation Date</th>
                                    <th style="text-align:center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($aquariums as $aquarium)
                                        <tr>
                                            <td>
                                                <a href="#">
                                                    {{$aquarium->id}}
                                                </a>
                                            </td>
                                            <th>{{$aquarium->description}}</th>
                                            <td>{{$aquarium->glass_type}}</td>
                                            <td>{{$aquarium->size}} <strong>litres</strong></td>
                                            <td>{{$aquarium->shape}}</td>
                                            <td>{{$aquarium->fish}}</td>
                                            <td>{{$aquarium->created_at}}</td>
                                            <td align="center">
                                                <a class="btn btn-primary" href="{{url('aquaria/show')}}{{'/'}}{{$aquarium->id}}" role="button">View</a>
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
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <form action="{{url('aquaria/storeaquaria')}}" method="post" enctype="multipart/form-data">
            @csrf
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Aquarium</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row my-2">
                        <div class="col-md-2">
                            <label>Description</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="description" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <label>Glass Type</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="glass_type" class="form-control" required>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-md-2">
                            <label>Size</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="size" min="0" step="0.1" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <label>Shape</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="shape" class="form-control" required>
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <span class="bi bi-save"> Save</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
