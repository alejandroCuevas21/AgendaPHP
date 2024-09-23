@extends('layouts.app')
@push('head')

@endpush
@section('content') 
@csrf

<div class="card cardPrimaria  mt-3">
    <div class="card-header cardEncabezado"><b>Consulta Agenda</b></div>
    <div class="card-body">

    <div class="row mt-3">
    <div class="d-flex justify-content-end">
   
    <a id="btnNuevaAgenda" class="btn btn-primary" href="{{ route('Agenda.InsertarAgenda') }}" ><i class="fa-solid fa-plus"    ></i>&nbsp;Nuevo</a>&nbsp;

</a>
        <a href="{{ url('/exportarExcel') }}" id="btnExcel" class="btn btn-success"><i class="fa-solid fa-file-excel"></i> </a>
</div>
<div class="row mt-3">
<hr/>
</div>
</div> 
    <div class="col-sm-12">

     <table class="table table-bordered" id="tblConsultaAgenda">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Calle</th>
                    <th>Número</th>
                    <th>Colonia</th>
                    <th>Ciudad</th>
                </tr>
            </thead>
            <tbody>
                @foreach($Agendas as $agenda)
                    <tr>
                   
                        <td><a class="btn btn-light"     href="{{ url('/ActualizaAgenda/' . $agenda->id) }}" ><i class="fa-regular fa-pen-to-square" ></i></a></td>
                        <td>{{ $agenda->Nombre }}</td> 
                        <td>{{ $agenda->Domicilio }}</td>
                        <td>{{ $agenda->Numero }}</td> 
                        <td>{{ $agenda->Colonia }}</td> 
                        <td>{{ $agenda->Ciudad }}</td> 
                    </tr>
                @endforeach
            </tbody>
        </table>
 </div>
</div>




<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
</div>

    <script type="text/javascript" src="{{ asset('js/Agenda/Consulta.js') }}"></script>
@endsection
