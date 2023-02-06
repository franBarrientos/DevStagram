@extends("layouts.app")

@section("titule")
    Crea una nueva Publicacion
@endsection

@push("styles")
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section("contenido")
    <div class=" md:flex md:items-center">
        <div class="md:w-1/2 px-10">
            <form method="POST" enctype="multipart/form-data" action="{{route("imagenes.store")}}" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
                @csrf     
            </form>
        </div>
        
        <div class="md:w-1/2 px-10  bg-white p-10 rounded-lg shadow-xl mt-10 md:mt.0">
            <form action="{{route("posts.store")}}" method="POST">
                @csrf
                <div class=" mb-5">
                    <label for="titulo" class=" mb-2 block uppercase text-gray-500 font-bold">
                        Titulo
                    </label>
                    <input type="text"
                        name="titulo"
                        id="titulo"
                        placeholder="Titulo de la Publicaion"
                        class=" p-3 border w-full rounded-lg @error("titulo") border-red-500 @enderror"
                        value="{{old("titulo")}}"
                    >
                    @error("titulo")
                        <p class=" bg-red-500 text-white uppercase p-2 my-2 rounded-lg text-center font-semibold">{{$message}}</p>
                    @enderror
                </div>
                <div class=" mb-5">
                    <label for="descripcion" class=" mb-2 block uppercase text-gray-500 font-bold">
                        Descripcion
                    </label>
                    <textarea 
                        name="descripcion"
                        id="descripcion"
                        placeholder="Descripcion de la Publicaion"
                        class=" p-3 border w-full rounded-lg @error("descripcion") border-red-500 @enderror"
                        
                    >{{old("descripcion")}}</textarea>
                    @error("descripcion")
                        <p class=" bg-red-500 text-white uppercase p-2 my-2 rounded-lg text-center font-semibold">{{$message}}</p>
                    @enderror
                </div>
                
              <div class="mb-5">
                <input type="hidden" name="imagen" value="{{old("imagen")}}">
                @error("imagen")
                        <p class=" bg-red-500 text-white uppercase p-2 my-2 rounded-lg text-center font-semibold">{{$message}}</p>
                    @enderror
              </div>
               
               
                <input type="submit" value="CREAR PUBLICACION" class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer p-3 uppercase font-bold w-full md:w-min text-white rounded-lg">
            </form>
        </div>

    </div>
@endsection