@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de Posts</h1>
@stop

@section('content')
    <div class="d-flex flex-row-reverse my-2">
        <a href="{{ route('posts.create') }}" class="btn btn-info"><i class="fas fa-plus"></i> Nuevo</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Título</th>
                <th class="text-center" scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>
                        <div class="d-inline-flex align-items-center">
                            <div>
                                <img class="rounded-circle" src="{{ Storage::url($item->img) }}"
                                    style="width:40px; height:40px;" />
                            </div>
                            <div class="ml-2">
                                {{ $item->titulo }}
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <div
                            class="py-2 px-4 rounded-pill @if ($item->status == 'PUBLICADO') bg-success @else bg-danger @endif text-secondary">
                            {{ $item->status }}</div>
                    </td>
                    <td>
                        <form action="{{route('posts.destroy', $item)}}" method="POST" class="form-inline">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="post" value="{{$item}}" />
                            <a href="{{route('posts.edit', $item)}}" class="btn btn-warning">
                                <i class="fas fa-edit"></i></a>
                            <button class="ml-2 btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-2">
        {{ $posts->links('vendor.pagination.simple-bootstrap-4') }}
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('info'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('info') }}',
                showConfirmButton: false,
                timer: 2500
            })
        </script>
    @endif
@stop
