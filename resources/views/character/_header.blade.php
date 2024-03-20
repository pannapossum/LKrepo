<div class="character-masterlist-categories">
    @if(!$character->is_myo_slot)
        {!! $character->category->displayName !!} ・ {!! $character->image->species->displayName !!} ・ {!! $character->image->rarity->displayName !!}
    @else
        MYO Slot @if($character->image->species_id) ・ {!! $character->image->species->displayName !!}@endif @if($character->image->rarity_id) ・ {!! $character->image->rarity->displayName !!}@endif
    @endif
</div>
<h1 class="mb-0">
    @if(Config::get('lorekeeper.extensions.character_status_badges'))
        <!-- character trade/gift status badges -->
        <div class="float-right">
            <span class="btn {{ $character->is_trading ? 'badge-success' : 'badge-danger' }} float-right ml-2" data-toggle="tooltip" title="{{ $character->is_trading ? 'OPEN for sale and trade offers.' : 'CLOSED for sale and trade offers.' }}"><i class="fas fa-comments-dollar"></i></span>
            @if(!$character->is_myo_slot)
                <span class="btn {{ $character->is_gift_writing_allowed == 1 ? 'badge-success' : ($character->is_gift_writing_allowed == 2 ? 'badge-warning text-light' : 'badge-danger') }} float-right ml-2" data-toggle="tooltip" title="{{ $character->is_gift_writing_allowed == 1 ? 'OPEN for gift writing.' : ($character->is_gift_writing_allowed == 2 ? 'PLEASE ASK before gift writing.' : 'CLOSED for gift writing.') }}"><i class="fas fa-file-alt"></i></span>
                <span class="btn {{ $character->is_gift_art_allowed == 1 ? 'badge-success' : ($character->is_gift_art_allowed == 2 ? 'badge-warning text-light' : 'badge-danger') }} float-right ml-2" data-toggle="tooltip" title="{{ $character->is_gift_art_allowed == 1 ? 'OPEN for gift art.' : ($character->is_gift_art_allowed == 2 ? 'PLEASE ASK before gift art.' : 'CLOSED for gift art.') }}"><i class="fas fa-pencil-ruler"></i></span>
            @endif
        </div>
    @endif
    @if($character->is_visible && Auth::check() && $character->user_id != Auth::user()->id)
        <?php $bookmark = Auth::user()->hasBookmarked($character); ?>
        <a href="#" class="btn btn-outline-info float-right bookmark-button ml-2" data-id="{{ $bookmark ? $bookmark->id : 0 }}" data-character-id="{{ $character->id }}"><i class="fas fa-bookmark"></i> {{ $bookmark ? 'Edit Bookmark' : 'Bookmark' }}</a>
    @endif
    @if(Config::get('lorekeeper.extensions.character_TH_profile_link') && $character->profile->link)
            <a class="btn btn-outline-info float-right" data-character-id="{{ $character->id }}" href="{{ $character->profile->link }}"><i class="fas fa-home"></i> Profile</a>
        @endif
    @if(!$character->is_visible) <i class="fas fa-eye-slash"></i> @endif {!! $character->displayName !!}
    @if ($character->user->settings->allow_character_likes)
        <div class="btn btn-primary float-right" data-toggle="tooltip"
            title="{{ ucfirst(__('character_likes.liked')) }}
             {{ $character->likeTotal }} times">
            <i class="fas fa-star"></i> {{ $character->likeTotal }}</a>
        </div>
    @endif
</h1>
<div class="mb-3">
    Owned by {!! $character->displayOwner !!}
</div>
@if (Auth::check() &&
        $character->user->settings->allow_character_likes &&
        Auth::user()->canLike($character) &&
        Auth::user()->id != $character->user_id)
    <div class="text-center">
        {!! Form::open(['url' => $character->url . '/like']) !!}
        {!! Form::submit(ucfirst(__('character_likes.like')), ['class' => 'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
@endif
