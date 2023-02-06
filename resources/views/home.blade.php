@extends("layouts.app")
@section("titule")
    Inicio
@endsection

@section("contenido")

        <x-ListarPost :posts="$posts"/>

      

        
@endsection

