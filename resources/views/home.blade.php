@extends('layouts.app')

@section('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/choices.min.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!--este cargar valores no cambiara de idioma porque esta fijo-->
                <div class="card-header">Cargar Valores</div>

                <div class="card-body">

                  @if($errors->any())
                    <div class="alert alert-danger">
                      <p>Se encontraron los siguientes errores:</p>
                        <ul>
                          @foreach($errors->all() as $error)
                              <li>
                               {{ $error }} 
                              </li>
                          @endforeach
                        </ul>
                    </div>
                  @endif

                   <form action="{{ url('/prices') }}" method="post">
                       {{ csrf_field() }}
                       <!--nunca enviar informacion sensible asi
                        <input type="hidden" id="user_id" name="user_id" value="{{ auth()->user()->id }}">
                        Ya que es facil modificar al inspeccionar la pagina-->

                       <div class="form-group">
                           <label for="location">{{ __('Locations') }}</label>
                           <select name="location_id" id="location" class="form-control">
                              <option placeholder value=""> Seleccione Ubicación</option>
                               @foreach($locations as $location)
                                <option value="{{ $location->id }}"> {{ $location->name }}</option>
                               @endforeach
                           </select>
                       </div>
                       <div class="form-group">
                           <label for="item"> {{ __('Items') }}</label>

                           <select name="item_id" id="item" class="form-control">
                              <option placeholder value=""> Seleccione Item</option>
                               @foreach ($items as $item)
                                <option value="{{ $item->id }}"> {{ $item->name }}</option>
                               @endforeach
                           </select>
                       </div>
                       <div class="form-group">
                           <label for="">Valor a cargar</label>
                           <input type="text" class="form-control" placeholder="0.00" id="value" name="value">
                       </div>
                        <div class="form-group">
                           <label for="date">Fecha Actual</label>
                           <input type="date" id="date" class="form-control" disabled="disabled" value="{{ date('Y-m-d') }}">
                       </div>
                       <button type="submit" class="btn btn-primary"> Confirmar y Cargar Valor</button>
                   </form>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                        Ultimos valores cargados
                    </div>

                    <div class="card-body">
                        <table class="table table-hover">
                             <thead>
                                 <tr>
                                     <th>Item</th>
                                     <th>Ubicación</th>
                                     <th>Valor</th>
                                     <th>Fecha de carga</th>
                                 </tr>
                             </thead>
                             <tbody>
                                @foreach ($prices as $price)
                                    <tr>
                                        <td> {{ $price->location->name}} </td>
                                        <td> {{ $price->item->name}} </td>
                                        <td> {{ $price->value}} </td>
                                        <td> {{ $price->created_at}} </td>
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

@section('scripts')
  <script type="text/javascript" src="{{ asset('js/choices.min.js') }}"></script>
  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded',function(){
      const items = new Choices('#item'); 
      const locations = new Choices('#location'); 
    });
    
  </script>
@endsection