@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span>{{ __('Aquarium Details') }}</span>
                    </div>
                    <div class="card-body">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Description</th>
                                        <td>{{$acquaria->description}}</td>

                                        <th>Glass Type</th>
                                        <td>{{$acquaria->glass_type}}</td>

                                        <th>Size</th>
                                        <td>{{$acquaria->size}} litres</td>

                                        <th>Shape</th>
                                        <td>{{$acquaria->shape}}</td>

                                        <th>Fish Count</th>
                                        <td>{{$acquaria->fish}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <span>{{ __('Fishes') }}</span>
                        <span class="float-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                            Add Fish
                        </button>
                    </span>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif

                        <div class="row mt-2">
                            <div class="col-md-12">
                                <table class="table table-hover table-bordered" id="datatable">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Species</th>
                                        <th>Color</th>
                                        <th>Number of Fins</th>
                                        <th>Creation Date</th>
                                        <th style="text-align:center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($acquaria->fish_array as $count=>$fish)
                                        <tr>
                                            <td>
                                                <a href="#">
                                                    {{++$count}}
                                                </a>
                                            </td>
                                            <th>{{$fish->species}}</th>
                                            <td>{{$fish->color}}</td>
                                            <td>{{$fish->number_of_fins}} <strong>fins</strong></td>
                                            <td>{{$fish->created_at}}</td>
                                            <td align="center">
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal{{$fish->id}}">
                                                    Edit
                                                </button>
                                                <a class="btn btn-danger" href="{{url('aquaria/removefish')}}{{'/'}}{{$fish->id}}" role="button">Delete</a>
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

    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">

                <form action="{{url('aquaria/storefish')}}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add Fish</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="row my-2">
                            <div class="col-md-4">
                                <label>Species</label>
                            </div>
                            <div class="col-md-7">
                                <select name="species" class="form-control" required>
                                    <option value="">Select</option>
                                    @foreach($fish_types as $specie)
                                        <option value="{{$specie}}">{{$specie}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-4">
                                <label>Color</label>
                            </div>
                            <div class="col-md-7">
                                <input type="text" name="color" class="form-control" required>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col-md-4">
                                <label>Number of Fins</label>
                            </div>
                            <div class="col-md-7">
                                <input type="number" name="number_of_fins" min="0" step="0.1" class="form-control" required>
                            </div>
                        </div>
                        <input type="hidden" name="aquaria_id" value="{{$acquaria->id}}">
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

    @foreach($acquaria->fish_array as $fish)
        <div class="modal" id="myModal{{$fish->id}}">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">

                    <form action="{{url('aquaria/updatefish')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Fish</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="row my-2">
                                <div class="col-md-4">
                                    <label>Species</label>
                                </div>
                                <div class="col-md-7">
                                    <select name="species" class="form-control" required>
                                        @foreach($fish_types as $specie)
                                            <option value="{{$specie}}" {{$fish->species == $specie ? 'selected' : ''}} >{{$specie}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-4">
                                    <label>Color</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="color" value="{{$fish->color}}" class="form-control" required>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-4">
                                    <label>Number of Fins</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="number" name="number_of_fins" value="{{$fish->number_of_fins}}" min="0" step="0.1" class="form-control" required>
                                </div>
                            </div>
                            <input type="hidden" name="fish_id" value="{{$fish->id}}">
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
    @endforeach

@endsection
