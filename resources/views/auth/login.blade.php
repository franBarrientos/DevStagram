@extends("layouts.app")

@section("titule")
    Inicia Sesion en DevStagram
@endsection

@section("contenido")
    <div class="md:flex md:justify-center md:items-center md:gap-10 ">
        <div class="md:w-7/12 p-5">
            <img class=" rounded-lg" src="{{asset("img/login.jpg")}}" alt="img-login">
        </div>
        <div class=" md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{route("login")}}" method="POST">
                @csrf
                @if (session("mensaje"))
                    <p class=" bg-red-500 text-white uppercase p-2 my-2 rounded-lg text-center font-semibold">{{session("mensaje")}}</p> 
                @endif
                
               
                <div class=" mb-5">
                    <label for="email" class=" mb-2 block uppercase text-gray-500 font-bold">
                        Email
                    </label>
                    <input name="email"
                        id="email"
                        type="email"
                        placeholder="Tu Email"
                        class=" p-3 border w-full rounded-lg @error("email") border-red-500 @enderror"
                        value="{{old("email")}}"
                    >
                    @error("email")
                        <p class=" bg-red-500 text-white uppercase p-2 my-2 rounded-lg text-center font-semibold">{{$message}}</p>
                    @enderror
                </div>
                <div class=" mb-5">
                    <label for="password" class=" mb-2 block uppercase text-gray-500 font-bold">
                        Password
                    </label>
                    <input type="password"
                        name="password"
                        id="password"
                        placeholder="Tu Password"
                        class=" p-3 border w-full rounded-lg @error("password") border-red-500 @enderror"
                        >
                        @error("password")
                        <p class=" bg-red-500 text-white uppercase p-2 my-2 rounded-lg text-center font-semibold">{{$message}}</p>
                    @enderror
                </div>

                <div class=" mb-5">
                    <input type="checkbox" name="remember"><label class="ml-2 text-gray-500 font-semibold">Mantener mi sesion Abierta</label>
                </div>
            
                
                <input type="submit" value="Iniciar Sesion" class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer p-3 uppercase font-bold w-full text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection