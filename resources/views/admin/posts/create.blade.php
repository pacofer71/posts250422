@extends('adminlte::page')

@section('title', 'Nuevo')

@section('content_header')
    <h1 class="text-center">Nuevo Post</h1>
@stop

@section('content')
    <div class="mx-auto border border-4 py-2 rounded px-4 shadow-lg" style="width:80rem">
        <x-form action="{{ route('posts.store') }}" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" />
            <x-form-input name="titulo" label="Título del Post" placeholder="Título" required />
            <x-form-textarea name="contenido" placeholder="Contenido" label="Contenido del Post" />
            <x-form-group name="status" label="Estado" inline>
                <x-form-radio name="status" value="PUBLICADO" label="Publicado" />
                <x-form-radio name="status" value="BORRADOR" label="Borrador" checked />
            </x-form-group>
            <div class="d-flex align-items-start mt-2 ">
                <div style="width:40rem">
                    <label for="img">Imagen del Post</label>
                    <input id='img' type="file" name="img" class="form-control" accept="image/*" />
                    @error('img')
                    <span class="text-danger text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="ml-4">
                    <img src="{{ asset('storage/noimage.png') }}" style="width:220px; height:220px" id="imagen" />

                </div>
            </div>
            <div class="mt-2 d-flex flex-row-reverse">
                <button type="submit" class="btn btn-info"><i class="fas fa-save"> Guardar</i></button>
                <button type="reset" class="mr-4 btn btn-warning"><i class="fas fa-brush"> Limpiar</i></button>
            </div>



        </x-form>
    </div>
@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        //Cambiar imagen
        document.getElementById("img").addEventListener('change', cambiarImagen);

        function cambiarImagen(event) {
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("imagen").setAttribute('src', event.target.result)
            };
            reader.readAsDataURL(file);
        }
    </script>
@stop
