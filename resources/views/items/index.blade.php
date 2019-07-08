@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrar Items</div>

                <div class="card-body">
                    <form action="{{ url('/items')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Item</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Ingrese nombre y presione Enter">
                        </div>

                    </form>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-header">Listado de Items</div>

                <div class="card-body">
                    <form action="{{ url('/items')}}" method="get">
                        <div class="form-group">
                            <input type="text" name="search" id="search" class="form-control" placeholder="Buscar por nombre" value=" {{ $search }}">
                        </div>

                    </form>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Fecha de registro</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <th>{{$item->name}}</th>
                                    <th>{{$item->created_at}}</th>
                                    <th>
                                        <form action="{{ url('/items/'.$item->id)}}" method="post">
                                             {{ csrf_field() }}
                                            {{ method_field('delete')}}
                                            <button class="btn btn-danger">
                                                Eliminar
                                            </button> 
                                        </form>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!--Genera la paginacion con el metodo links, el metodo appends ayuda para que la paginacion no pierda el texto que esta buscando -->
                    {{ $items->appends(['search' => $search])->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
