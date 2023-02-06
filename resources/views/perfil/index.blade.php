@extends("layouts.app")

@section("titule")
    Edita tu perfil: {{auth()->user()->username}} 
@endsection



@section("contenido")
    <div class="md:flex md:justify-center">
        <div class=" md:w-1/2 bg-white shadow p-6">
            <form action="{{route("perfil.store",["user" => auth()->user()])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class=" mb-5">

                    <label for="username" class=" mb-2 text-gray-500 uppercase block font-bold">
                        Username
                    </label>
                    <input type="text" id="username" name="username" placeholder="Tu nombre" value="{{auth()->user()->username}}" class="w-full border p-3 rounded-lg @error('name') border-red-500 @enderror">     
                     
                    @error("username")
                        <p class=" bg-red-500 text-white uppercase text-sm rounded-lg p-2 my-2 text-center">{{$message}}</p>
                    @enderror
            




                </div>
                <div class=" mb-5">

                    <label for="email" class=" mb-2 text-gray-500 uppercase block font-bold">
                        Email
                    </label>
                    <input type="email" id="email" name="email" placeholder="Tu Email" value="{{auth()->user()->email}}" class="w-full border p-3 rounded-lg @error('email') border-red-500 @enderror">     
                     
                    @error("email")
                        <p class=" bg-red-500 text-white uppercase text-sm rounded-lg p-2 my-2 text-center">{{$message}}</p>
                    @enderror
            




                </div>
                <div class=" mb-5">

                    <label for="imagen" class=" mb-2 text-gray-500 uppercase block font-bold">
                        imagen Perfil
                    </label>
                    <input type="file" accept=".png, .jpeg, .png" id="imagen" name="imagen" class="w-full border p-3 rounded-lg">     
                     
                </div>
                <input type="submit" value="Guardar Cambios" class="w-full rounded-lg text-white hover:cursor-pointer p-3 uppercase text-center font-bold bg-sky-600 hover:bg-sky-700 transition-colors "></input>
            </form>
        </div>
    </div>
@endsection