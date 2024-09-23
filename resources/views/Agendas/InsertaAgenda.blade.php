@extends('layouts.app')

@section('content') 

<div class="card mt-3 cardPrimaria">
    <div class="card-header cardEncabezado"><b>{{ $Accion == 'Actualizar' ? 'Actualizar' : 'Nuevo' }} Contacto</b></div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <label for="txtNombre">Nombre</label>
                <input type="text" id="txtNombre" class="form-control" value="{{ $Accion == 'Actualizar' ? $contacto->Nombre : '' }}">

            </div>

            <div class="row mt-3">
                <div class="col-sm-6">
                    <label for="txtDomicilio">Domicilio</label>
                    <input type="text" id="txtDomicilio" class="form-control" value="{{ $Accion == 'Actualizar' ? $contacto->Domicilio : '' }}">
                </div>
                <div class="col-sm-2">
                    <label for="txtNumero">Número</label>
                    <input type="number" id="txtNumero" class="form-control" value="{{ $Accion == 'Actualizar' ? $contacto->Numero : '' }}">
                </div>

                <div class="col-sm-4">
                    <label for="txtColonia">Colonia</label>
                    <input type="text" id="txtColonia" class="form-control" value="{{ $Accion == 'Actualizar' ? $contacto->Colonia : '' }}">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-3">
                    <label for="txtCP">Código Postal</label>
                    <input type="text" id="txtCP" class="form-control" value="{{ $Accion == 'Actualizar' ? $contacto->CP : '' }}">
                </div>
                <div class="col-sm-5">
                    <label for="txtCiudad">Ciudad</label>
                    <input type="text" id="txtCiudad" class="form-control" value="{{ $Accion == 'Actualizar' ? $contacto->Ciudad : '' }}">
                </div>

                <div class="col-sm-4">
                    <label for="txtEstado">Estado</label>
                    <input type="text" id="txtEstado" class="form-control" value="{{ $Accion == 'Actualizar' ? $contacto->Estado : '' }}">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-6">
                    <label for="txtTelefono">Teléfono</label>
                    <input type="text" id="txtTelefono" class="form-control" maxlength="10" value="{{ $Accion == 'Actualizar' ? $contacto->Telefono : '' }}">
                </div>
                <div class="col-sm-6">
                    <label for="txtCorreo">Correo Electrónico</label>
                    <input type="text" id="txtCorreo" class="form-control" value="{{ $Accion == 'Actualizar' ? $contacto->Correo : '' }}">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-sm-5">
                    <label for="txtLatitud">Latitud</label>
                    <input type="text" id="txtLatitud" class="form-control" disabled="disabled" value="{{ $Accion == 'Actualizar' ? $contacto->Latitud : '' }}"  >
                </div>

                <div class="col-sm-5">
                    <label for="txtLongitud">Longitud</label>
                    <input type="text" id="txtLongitud" class="form-control" disabled="disabled" value="{{ $Accion == 'Actualizar' ? $contacto->Longitud : '' }}">
                </div>
                <div class="col-sm-2 mt-4">
                    <a class="btn btn-success" id="btnCargarDatosGPS" style="font-size:12px;" onclick="validarFormulario()">
                        <i class="fa-solid fa-location-dot"></i>&nbsp;Cargar Datos GPS
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer FooterPrimarioCard">
        <div class="d-flex justify-content-end">
            <a id="btnCancelar" class="btn btn-secondary"><i class="fa-solid fa-ban"></i>&nbsp;Cancelar</a>&nbsp;
            <a id="btnGuardar" class="btn btn-primary" onclick="GuardarContacto('{{ $Accion }}', {{ $contacto->id ?? 'null' }})">
                <i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar
            </a>
        </div>
    </div>
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
</div>

<script type="text/javascript" src="{{ asset('js/Agenda/Insertar.js') }}"></script>
@endsection
