@extends('app')

@section('contenido')
    <div class="container mt-4">
        <h2 class="mb-4">Productos</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>PRECIO</th>
                    <th>VALORACIÓN</th>
                    <th colspan="2">VALORAR</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr>
                        <td>{{ $producto->getId() }}</td>
                        <td>{{ $producto->getNombre() }}</td>
                        <td>{{ $producto->getPvp() }} €</td>
                        <td>
                            <div id="votos_{{ $producto->getId() }}">
                                @php
                            $media = $votosDAO->recuperaMediaVotos($producto->getId());
                            $total = $votosDAO->contarVotos($producto->getId());
                        @endphp
                                @if($total > 0)
                                    {{ $total }} {{ $total === 1 ? 'Valoración' : 'Valoraciones' }}
                                    {!! \App\PintarEstrellas::render($media) !!}
                                @else
                        Sin valorar
                                @endif
                            </div>
                        </td>
                        <td>
                            <select class="form-select form-select-sm select-voto" 
                            style="width:80px;display:inline"
                            data-producto="{{ $producto->getId() }}">
                                @for($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary btn-votar"
                            data-producto="{{ $producto->getId() }}">Votar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="js/votos.js"></script>
@endsection