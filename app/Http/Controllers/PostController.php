<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::query()
        ->where('user_id', auth()->user()->id)
        ->orderBy('id', 'desc')
        ->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $imagen = $request->img->store('img');
        Post::create([
            'titulo'=>$request->titulo,
            'contenido'=>$request->contenido,
            'user_id'=>$request->user_id,
            'img'=>$imagen,
            'status'=>$request->status
        ]);
        return redirect()->route('posts.index')->with('info', "Post Guardado");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $imagen = $post->img;
        //compruebo si he subido una imagen
        if($request->img){
            //Borro la imagen anterior
            Storage::delete($post->img);
            //subo la nueva
            $imagen = $request->img->store('img');
        }
        $post->update([
            'titulo'=>$request->titulo,
            'contenido'=>$request->contenido,
            'user_id'=>$request->user_id,
            'img'=>$imagen,
            'status'=>$request->status
        ]);
        return redirect()->route('posts.index')->with('info', "Post Editado");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //Borramos la imagen
        Storage::delete($post->img);
        //Borramos el registro
        $post->delete();
        //Info
        return redirect()->route('posts.index')->with('info', "Post Borrado");
    }
}
