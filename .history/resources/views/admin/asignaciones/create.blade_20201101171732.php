@extends('layouts.body')

@section('css')
    
@endsection


@section('contenido_page')
<div class="layout-content">

    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-0">Nuevo Asignacion</h4>

        {{-- @include('admin.usuario.navar') --}}

        <div class="row">
            <div class="col-sm-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                                <th scope="col">#</th>
                                <th scope="col">Lunes</th>
                                <th scope="col">Martes</th>
                                <th scope="col">Miercoles</th>
                                <th scope="col">Jueves</th>
                                <th scope="col">Viernes</th>
                        </tr>
                    </thead>
                    <tbody>
                     
                    </tbody>
                  </table>

            </div>
        </div>

    </div>
    <!-- [ content ] End -->
</div>
@endsection


@section('script')
    
@endsection