@extends('character.layout', ['isMyo' => $character->is_myo_slot])

@section('profile-title')
    {{ $character->fullName }}'s Comments
@endsection

@section('meta-img')
    {{ $character->image->thumbnailUrl }}
@endsection

@section('profile-content')
    @if ($character->is_myo_slot)
        {!! breadcrumbs(['MYO Slot Masterlist' => 'myos', $character->fullName => $character->url, 'comments' => $character->url . '/comments']) !!}
    @else
        {!! breadcrumbs([
            $character->category->masterlist_sub_id ? $character->category->sublist->name . ' Masterlist' : 'Character masterlist' => $character->category->masterlist_sub_id ? 'sublist/' . $character->category->sublist->key : 'masterlist',
            $character->fullName => $character->url,
            'comments' => $character->url . '/comments',
        ]) !!}
    @endif

    @include('character._header', ['character' => $character])

    <div class="mb-3">
        @if($allowComments)
            @comments(['model' => $character, 'perPage' => 5])
        @else
            <div class="alert alert-secondary text-center" role="alert">
                Comments are disabled.
            </div>
        @endif
    </div>

@endsection
