<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function insert(Request $request){

        $request->validate([
            'nome' => 'required|max:255',
            'info' => 'required',
        ]);

        Post::create($request->all());
   
        return redirect('/lista-posts')->with('success', 'item inserido com sucesso');
		
    }

    public function show($id){

        $actionForm = route('post.update');
        $item = Post::findOrFail($id);

        return view('pagina', compact('item','actionForm'));
        
    }

    public function update(Request $request){

        $request->validate([
            'nome' => 'required|max:255',
            'info' => 'required',
        ]);


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
