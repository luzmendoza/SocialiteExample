@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Monitor</div>

                <div class="card-body">
                    <form action="{{ url('/locations')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Ubicación</label>
                            <input type="text" name="name" id="name" class="form-control" required="required">
                        </div>

                    </form>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Ubicación</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($locations as $location)
                                <tr>
                                    <th>{{$location->name}}</th>
                                    <th>

                                        <form action="{{ url('/locations/'.$location->id)}}" method="post">
                                             {{ csrf_field() }}
                                            {{ method_field('delete')}}
                                            <a href="{{url('/locations/'.$location->id)}}" class="btn btn-info">
                                                Editar
                                            </a>
                                            <button class="btn btn-danger">
                                                Eliminar
                                            </button> 
                                        </form>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
