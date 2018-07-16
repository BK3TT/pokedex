<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;

class pokemon extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function save($pokemon = null){
        if(!$pokemon) return false;

        $data = array("name" => $pokemon["name"], "height" => $pokemon["height"], "weight" => $pokemon["weight"], "image" => $pokemon["sprites"]["front_default"]);

        $dataID = DB::table("pokemon")->insertGetId($data);

        $this->saveAbilities($pokemon, $dataID);
    }

    private function saveAbilities($abilities = null, $lastID = null){
        if(!$abilities && !$lastID) return false;

        foreach($abilities["moves"] as $key => $val){
            if($val["move"]){
                $data = array("name" => $val["move"]["name"], "pokemon_id" => $lastID);
                DB::table("pokemon_abilities")->insert($data);
            } else {
                continue;
            }
        }

        $this->saveTypes($abilities, $lastID);
    }

    private function saveTypes($types = null, $lastID = null){
        if(!$types && !$lastID) return false;

        foreach($types["types"] as $key => $val){
            if($val["type"]){
                $data = array("name" => $val["type"]["name"], "pokemon_id" => $lastID);
                DB::table("pokemon_types")->insert($data);
            } else {
                continue;
            }
        }
    }

    public function getAll(){
        $pokemon =  DB::table('pokemon')->paginate(20);
        $pokemonAbilities =  DB::table('pokemon_abilities')->get();
        $pokemonTypes =  DB::table('pokemon_types')->get();
        return view('home', ['pokemon' => $pokemon, 'pokemonAbilities' => $pokemonAbilities, 'pokemonTypes' => $pokemonTypes]);
    }
}
