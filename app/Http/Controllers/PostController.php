<?php

namespace App\Http\Controllers;


use App\Http\Requests\PostRequest;

use App\Models\Post;

class PostController extends Controller
{
    

    public function lista(){

        $lista = Post::all();
        
        return view('lista',compact('lista'));
    }

    public function novo(){

        $actionForm = route('post.insert');
		return view('pagina',compact('actionForm'));
    }

    public function insert(PostRequest $request){

        Post::create($request->all());
   
        return redirect('/lista-posts')->with('success', 'item inserido com sucesso');
		
    }

    public function show($id){

        $actionForm = route('post.update');
        $item = Post::findOrFail($id);

        return view('pagina', compact('item','actionForm'));
        
    }

    public function update(PostRequest $request){

        $item         = Post::findOrFail($request->id); //primary id
        $item->nome   = $request->nome;
        $item->info   = $request->info;
        $item->save();

        return redirect('/lista-posts')->with('success', 'item editado com sucesso');
        
    }

    public function destroy($id){

        $item = Post::findOrFail($id);
        $item->delete();

        return redirect('/lista-posts')->with('success', 'item excluido com sucesso');
    }
    
}
