<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AccessLevel;
use App\KnowledgeProduct;
use App\KnowledgeCategory;
use Auth;

class SearchController extends Controller
{
    //
    protected function searchPublic(){
        if(Auth::check()){
            $knowledgeProductsId = KnowledgeProduct::all()->filter(function($knowledge){
                return Auth::user()->can('view', $knowledge);
            })->pluck('id');
            $knowledge = KnowledgeProduct::whereIn('id', $knowledgeProductsId)
                ->where('keywords','like','%'.$_GET['q'].'%')->paginate(20);
        }else{                        
            $knowledgeProductsId = KnowledgeProduct::all()->filter(function($knowledge){
                return $knowledge->accessLevel->level_number < 1;
            })->pluck('id');

           $knowledge = KnowledgeProduct::whereIn('id', $knowledgeProductsId)
                ->where('keywords','like','%'.$_GET['q'].'%')
                ->where('approved', true)->orderByDesc('created_at')->paginate(20);
        }

        return view('search.search_public')
            ->with('knowledge', $knowledge)->with('q', $_GET['q']);
    }

    protected function searchPublicCategory($category){

        $knowledgeCategory = KnowledgeCategory::firstOrCreate(['category'=> $category]);

        if(Auth::check()){
            $knowledgeProductsId = KnowledgeProduct::all()->filter(function($knowledge){
                return Auth::user()->can('view', $knowledge);
            })->pluck('id');
            $knowledge = KnowledgeProduct::whereIn('id', $knowledgeProductsId)->where('keywords','like','%'.$_GET['q'].'%')->where('knowledge_category_id', $knowledgeCategory->id)->paginate(20);
        }else{
            
            $knowledgeProductsId = KnowledgeProduct::all()->filter(function($knowledge){
                return $knowledge->accessLevel->level_number < 1;
            })->pluck('id');

            $knowledge = KnowledgeProduct::whereIn('id', $knowledgeProductsId)
                ->where('knowledge_category_id', $knowledgeCategory->id)
                ->where('keywords','like','%'.$_GET['q'].'%')
                ->where('approved', true)->orderByDesc('created_at')->paginate(20);
        }
    
        return view('search.search')
            ->with('knowledge', $knowledge)->with('q', $_GET['q']);
    }
    
    protected function orderBy($column, $order){
        
        if(Auth::check()){
            $knowledgeProductsId = KnowledgeProduct::all()->filter(function($knowledge){
                return Auth::user()->can('view', $knowledge);
            })->pluck('id');
            $knowledge = KnowledgeProduct::whereIn('id', $knowledgeProductsId)
                ->where('keywords','like','%'.$_GET['q'].'%')
                ->orderBy($column, $order)->paginate(20)
                ->paginate(20);
        }else{                        
            $knowledgeProductsId = KnowledgeProduct::all()->filter(function($knowledge){
                return $knowledge->accessLevel->level_number < 1;
            })->pluck('id');

           $knowledge = KnowledgeProduct::whereIn('id', $knowledgeProductsId)
                ->where('keywords','like','%'.$_GET['q'].'%')
                ->orderBy($column, $order)->paginate(20)
                ->where('approved', true)->orderByDesc('created_at')->paginate(20);
        }

        return view('search.search_public')
            ->with('knowledge', $knowledge)->with('q', $_GET['q']);

        $knowledge = KmProduct::where('access_level','low level')
            ->where('keywords','like','%'.$_GET['q'].'%')
            ->orderBy($column, $order)->paginate(20);
        return view('search.search_public')->with('knowledge', $knowledge)->with('q', $_GET['q']);
    }

    protected function searchDetail(KnowledgeProduct $knowledgeProduct){

        if(Auth::check()){
            $this->authorize('view', $knowledgeProduct);
        }else{

            $accessLevel = AccessLevel::firstOrCreate(['level'=>'low level', 'level_number' => 0]);
            if($knowledgeProduct->accessLevel->level_number > 0 || !$knowledgeProduct->approved)
                abort(403);
        }
        
        $knowledgeProduct->views++;
        $knowledgeProduct->save();
        
        return view('search.search_detail')->with('knowledge', $knowledgeProduct);
    }

}
