<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Recipe;
use App\Models\Tool;
use App\Models\Ingredient;
use App\Models\RecipeView;
use App\Models\Rating;


class RecipeController extends Controller
{

    public function show_recipes(){

        $recipes = Recipe::with('user')->where('status_resep','publish')->get();

        $data = [];

        foreach ($recipes as $recipe) {
            array_push($data,[
                'idresep'=>$recipe->idresep,
                'judul'=>$recipe->judul,
                'gambar'=>url($recipe->gambar),
                'name'=>$recipe->user->name
            ]);
        }
        return response()->json($data,200);
    }

    public function recipe_by_id(Request $request){

        $validator = Validator::make($request->all(),[
            'idresep' => 'required',
            'email' => 'email'
        ]);

        if ($validator->fails()){
            return messageError($validator->messages()->toArray());
        }

        $recipe = Recipe::where('status_resep','publish')
        ->where('idresep',$request->idresep)
        ->get();
        $tools=Tool::where('resep_idresep',$request->idresep)->get();
        $ingredient=Ingredient::where('resep_idresep',$request->idresep)->get();
        
        $data = [];
        foreach($recipe as $recipe){
            array_push($data,[
                'idresep'=>$recipe->idresep,
                'judul'=>$recipe->judul,
                'gambar'=>url($recipe->gambar),
                'cara_pembuatan'=>$recipe->cara_pembuatan,
                'video'=>$recipe->video,
                'name'=>$recipe->user->nama
            ]);
        }

        $recipeData=[
            'recipe'=>$data,
            'tools'=>$tools,
            'ingredient'=>$ingredient
        ];

        RecipeView::create([
            'email'=>$request->email,
            'date'=>now(),
            'resep_idresep'=>$request->idresep
        ]);

        return response()->json($recipeData,200);
    }

    public function rating(Request $request){
        $validator = Validator::make($request->all(),[
            'idresep'=>'required',
            'email'=>'required|email',
            'rating'=>'required|in:1,2,3,4,5'
        ]);

        if ($validator->fails()){
            return messageError($validator->messages()->toArray());
        }

        Rating::create([
            'rating'=>$request->rating,
            'review'=>$request->review,
            'resep_idresep'=>$request->idresep,
            'email_users'=>$request->email
        ]);

       return response()->json([
            'data'=>[
                'msg'=>"rating berhasil tersimpan"
            ]
        ]);
    }
}
