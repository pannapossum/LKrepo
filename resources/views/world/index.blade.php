@extends('world.layout')

@section('world-title')
    Home
@endsection

@section('content')
    {!! breadcrumbs(['Encyclopedia' => 'world']) !!}

    <h1>World</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="{{ asset('images/characters.png') }}" alt="Characters" />
                    <h5 class="card-title">Characters</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{ url('world/species') }}">Species</a></li>
                    <li class="list-group-item"><a href="{{ url('world/subtypes') }}">Subtypes</a></li>
                    <li class="list-group-item"><a href="{{ url('world/rarities') }}">Rarities</a></li>
                    <li class="list-group-item"><a href="{{ url('world/trait-categories') }}">Trait Categories</a></li>
                    <li class="list-group-item"><a href="{{ url('world/traits') }}">All Traits</a></li>
                    <li class="list-group-item"><a href="{{ url('world/character-categories') }}">Character Categories</a></li>
                    <li class="list-group-item"><a href="{{ url('world/'.__('transformations.transformations')) }}">{{ ucfirst(__('transformations.transformations')) }}</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="{{ asset('images/inventory.png') }}" alt="Items and {{ ucfirst(__('awards.awards')) }} and Companions" />
                    <h5 class="card-title">Items & {{ ucfirst(__('awards.awards')) }} & Companions</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{ url('world/item-categories') }}">Item Categories</a></li>
                    <li class="list-group-item"><a href="{{ url('world/items') }}">All Items</a></li>
                    <li class="list-group-item"><a href="{{ url('world/' . __('awards.award') . '-categories') }}">{{ ucfirst(__('awards.award')) }} Categories</a></li>
                    <li class="list-group-item"><a href="{{ url('world/' . __('awards.awards')) }}">All {{ ucfirst(__('awards.awards')) }}</a></li>
                    <li class="list-group-item"><a href="{{ url('world/currencies') }}">Currencies</a></li>
                    <li class="list-group-item"><a href="{{ url('world/collections') }}">Collections</a></li>
                    <li class="list-group-item"><a href="{{ url('world/character-titles') }}">All Character Titles</a></li>
                    <li class="list-group-item"><a href="{{ url('world/pet-categories') }}">Pet Categories</a></li>
                    <li class="list-group-item"><a href="{{ url('world/pets') }}">All Pets</a></li>
                    <li class="list-group-item"><a href="{{ url('world/recipes') }}">All Recipes</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
