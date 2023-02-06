@extends("layouts.app")

@section("titule")
    {{$post->titulo}}
@endsection

@section("contenido")
    <div class=" container mx-auto md:flex md:justify-center">
        <div class="md:w-1/2 lg:w-4/12">
            <img src="{{asset("uploads/".$post->imagen)}}" alt="img of post {{$post->titulo}}">
            <div class=" p-3 flex items-center gap-2">
                @auth

                    <livewire:like-post :post="$post">
                    
                   
                @endauth
                

            </div>
            <div class=" p-2  gap-1 items-center">
                <p class=" font-bold">{{$post->user->username}}</p>
                <p class=" text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</p>               
            </div>
            <p class="p-2  items-center">
                {{$post->descripcion}}    
            </p> 
            @auth
                @if ($post->user_id == auth()->user()->id)
                    <form method="POST" action="{{route("posts.destroy",['post' => $post])}}">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value="Eliminar Publicacion" class="
                        bg-red-500
                        hover:bg-red-600
                        p-2 rounded mt-4 cursor-pointer
                        text-white 
                        ">
                    </form>
                @endif
                
            @endauth
            
        </div>
        <div class="md:w-1/2 lg:w-6/12 p-5 ">
            <div class="shadow bg-white p-5 mb-5 rounded-lg">
                @auth
                <p class=" text-xl font-bold text-center">Agrega un nuevo Comentario</p>
                @if (session("mensaje"))
                <p class=" bg-green-500 text-white uppercase p-2 my-2 rounded-lg text-center font-semibold">{{session("mensaje")}}</p>

                @endif
                <form action="{{route("comentarios.store",['user' => $user->username, 'post' => $post])}}" method="POST">
                    @csrf
                    <div class=" mb-5">
                        <label for="comentario" class=" mb-2 block uppercase text-gray-500 font-bold pt-2">
                            Descripcion
                        </label>
                        <textarea 
                            name="comentario"
                            id="comentario"
                            placeholder="Agrega un Comentario"
                            class=" p-3 border w-full rounded-lg @error("comentario") border-red-500 @enderror"
                            
                        ></textarea>
                        @error("comentario")
                            <p class=" bg-red-500 text-white uppercase p-2 my-2 rounded-lg text-center font-semibold">{{$message}}</p>
                        @enderror
                    </div>

                    <input type="submit" value="Comentar" class=" bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer p-3 uppercase font-bold w-full md:w-min text-white rounded-lg">

                </form>  
                @endauth

                <div class="rounded bg-white shadow my-5 max-h-96 overflow-y-hidden">
                    @if($post->comentarios->count())
                        @foreach ($post->comentarios as $comentario)
                            <div class="font-semibold p-5  border-gray-300 border-b last-of-type:border-none">
                                <a class=" font-bold" href="{{route('post.index',$comentario->user)}}">{{$comentario->user->username}}</a><p>{{$comentario->comentario}} </p>
                                <p class="text-sm text-gray-500">{{$comentario->created_at->diffForHumans()}} </p>
                            </div>
                        @endforeach

                    @else
                        <p class=" font-bold text-center p-2">No Hay comentarios aun</p>
                    @endif
                </div>


                @guest
                    <a class="text-xl font-semibold text-gray-500 cursor-pointer " href="{{route("login")}}"><p class="text-center">                    Inicia Sesion aqui para Comentar
                    </p></a>
                @endguest
            </div>
        </div>
    </div>
    
@endsection