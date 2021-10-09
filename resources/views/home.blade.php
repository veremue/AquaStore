@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span>{{ __('Aquariums') }}</span>
                    <span class="float-right"><button type="button" class="btn btn-primary">Add</button></span>
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
                                                <button type="button" class="btn btn-primary">View</button>
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
@endsection
