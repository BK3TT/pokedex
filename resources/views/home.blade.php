<?php
    /* Some simple code to save the pokemon from API to a database,
        this is so that you don't have to keep making request to the API
        as they have a limit on requests.

        $found = true;
        $x = 1;

        while($found && $x <= 158){
            $pokeData = file_get_contents("http://pokeapi.co/api/v2/pokemon/" . $x);
            if($pokeData !== ""){
                $foundPokemon = json_decode($pokeData, true);
                $pokemon->save($foundPokemon);
            } else {
                $found = false;
            }
            $x++;
        }
    */
?>
<!-- Include default layout for pages -->
@extends("layouts.app")

@section('content')
   <div class="container text-center">
       <h2>Pokédex</h2>
       {{ $pokemon->links() }}
       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
           @foreach ($pokemon as $selected)
               <div class="card col-xs-12 col-sm-12 col-md-3 col-lg-3">
                   <div class="panel panel-default">
                       <div class="panel-heading">{{ $selected->name}}</div>
                       <div class="panel-body">
                           <div class="image col-xs-12 col-sm-12 col-md-12 col-lg-12">
                               <img src="{{ $selected->image}}" alt="{{ $selected->name}}">
                           </div>
                           <div class="height col-xs-12 col-sm-12 col-md-6 col-lg-6"><span class="heading">H: </span><span class="desc">{{ $selected->height}}</span></div>
                           <div class="weight col-xs-12 col-sm-12 col-md-6 col-lg-6"><span class="heading">W: </span><span class="desc">{{ $selected->weight}}</span></div>
                           <div class="spacer col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
                           <div class="btn-group btn-group-justified">
                               <div class="abilitiesBtn btn btn-primary col-xs-12 col-sm-12 col-md-6 col-lg-6">Abilities</div>
                               <div class="typesBtn btn btn-danger col-xs-12 col-sm-12 col-md-6 col-lg-6">Types</div>
                           </div>
                       </div>
                   </div>
                   <div class="abilities text-center">
                       <h1>Abilities</h1>
                       @foreach ($pokemonAbilities as $ability)
                           @if($ability->pokemon_id === $selected->id)
                               <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">{{ $ability->name}}</div>
                           @endif
                       @endforeach
                   </div>
                   <div class="types text-center">
                       <h1>Types</h1>
                       @foreach ($pokemonTypes as $type)
                           @if($type->pokemon_id === $selected->id)
                               <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">{{ $type->name}}</div>
                           @endif
                       @endforeach
                   </div>
               </div>
           @endforeach
       </div>
   </div>
@endsection