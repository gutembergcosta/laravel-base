<?php

namespace App\Http\ControllersVue;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Validator;
use Illuminate\Support\Facades\DB;

class PostApiController extends Controller
{
    public function lista(){

        $lista = Post::all();
        
        $data = [
            'status' => 'post-success',
            'data' => $lista,
        ]; 

        return response()->json($data,201);
    }

    public function novo(){

        $actionForm = route('post.insert');
		return view('pagina',compact('actionForm'));
    }

    public function insert(PostRequest $request){

        Post::create($request->all());

        $data['status'] = 'post-success';
        $data['msg'] = 'item inserido com sucesso';
   
        return response()->json($data,200);
		
    }

    public function salvarDB(Request $request){

        $validator = Validator::make($request->all(), [
            
            'Nome'  => 'required',
            'Texto' => 'required',
        ]);


        if($validator->fails()){
            return response()->json($validator->errors(), 200);
        }

        if ($validator->passes()) {

            DB::table('postsSIB')->insert([
                'Nome'  => $request->Nome,
                'Texto' => $request->Texto
            ]);

            $data['status'] = 'post-success';
            $data['msg']    = 'item inserido com sucesso';
    
            return response()->json($data,200);
        }
    }

    public function listSIB(){

        $data['IDCodigo'] = 1;

        return DB::select('select * from postsSIB where IDCodigo = :IDCodigo', $data);


    }


    public function show($id){

        $data = Post::findOrFail($id);


        $data = [
            'status' => 'post-success',
            'data' => $data,
        ]; 
   
        return response()->json($data,201);
        
    }

    public function update(PostRequest $request){

        $item           = Post::findOrFail($request->id); //primary id
        $item->nome     = $request->nome;
        $item->texto    = $request->texto;
        $item->save();

        $data['status'] = 'post-success';
        $data['msg'] = 'item editado com sucesso';
   
        return response()->json($data,200);
        
    }

    public function destroy($id){

        $item = Post::findOrFail($id);
        $item->delete();

        $data['status'] = 'post-delete';
        $data['msg'] = 'item excluído com sucesso';

        return response()->json($data,201);
    }

    public function ajaxImageUploadPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        if ($validator->passes()) {

            $img = uniqid().'.'.$request->image->extension();

            $input = $request->all();
            $input['image'] = $img;
            $request->image->move(public_path('images'), $input['image']);


            $urlImg = url("public/images/$img");


            return response()->json([
                'success'=>'done',
                'url'=>$urlImg
            ]);
        }


        return response()->json(['error'=>$validator->errors()->all()]);
    }
    
}
