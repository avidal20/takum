@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Gesti&oacute;n de productos</h1>

            <ul class="breadcrumb">
              <li class="active">Inicio</li>
            </ul>

            <h2>Categorias</h2>

            <table class="table table-responsive">
                <thead>
                  <tr>
                    <th>Titulo</th>
                    <th>Descripcion</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category['name'] }}</td>
                        <td>Doe</td>
                        <td>john@example.com</td>
                        <td>
                            <a href="#" class="btn btn-default">Editar</a>
                            <a href="#" class="btn btn-default">Eliminar</a>
                            <a href="#" class="btn btn-default">Productos</a>
                        </td>
                  </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
