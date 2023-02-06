@extends("layouts.app")
@section("titule")
     Perfil: {{$user->username}}
@endsection

@section("contenido")
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row ">
            <div class="w-8/12 lg:w-6/12 px-5 ">
                <img class=" rounded-full" src="{{ $user->imagen ? asset("perfiles/".$user->imagen) : asset("img/usuario.svg")}}" alt="user img">
            </div>
            <div class=" md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:items-start md:justify-center text-left py-10">

                <div class=" md:flex gap-1 ">
                   <p class=" text-gray-700 text-3xl mb-3 font-semibold">{{$user->username}}</p>
                @auth
                    @if ($user->id == auth()->user()->id)
                        <a class=" hover:cursor-pointer " href="{{route("perfil.index",["user" => auth()->user()])}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>
                                  
                        </a>                
        
                    @endif
                @endauth

                </div>
                
                <p class=" text-gray-800 text-sm mb-3 font-bold">{{$user->followers->count()}}
                    <span class=" font-normal">{{$user->followers->count() == 1 ? 'Seguidor' : 'Seguidores' }} </span>
                </p>
                <p class=" text-gray-800 text-sm mb-3 font-bold">{{$user->followings->count()}}
                    <span class=" font-normal">Siguiendo</span>
                </p>
                <p class=" text-gray-800 text-sm mb-3 font-bold">{{$user->posts->count()}}
                    <span class=" font-normal">Posts</span>
                </p>
                @auth

                    @if (auth()->user()->id !== $user->id)

                        @if ($user->followers->contains(auth()->user()))
                 
                            <form action="{{route("users.unfollow",["user" => $user])}}" method="POST">
                                @csrf
                                @method("DELETE")
                                <input type="submit" class="my-1 uppercase text-white text-center text-sm font-semibold bg-red-600 hover:bg-red-700 transition-colors hover:cursor-pointer px-3 py-1 rounded-lg" value="dejar de seguir">
                            </form>      
                        @else
                            <form action="{{route("users.follow",["user" => $user])}}" method="POST">
                                @csrf
                                <input type="submit" class="uppercase text-white text-center text-sm font-semibold bg-sky-600 hover:bg-sky-700 transition-colors hover:cursor-pointer px-3 py-1 rounded-lg" value="SEGUIR">
                            </form>  
                        
                        @endif

                       

                    
                    @endif
                     
                @endauth
              
            </div>
        </div>
    </div>
    <section class="container mx-auto mt-10">
        <h2 class=" text-4xl text-center font-black my-10">Publicaciones</h2>
        
        <x-ListarPost :posts="$posts"/>
        
    </section>
@endsection