{{-- Image Data --}}
<div class="col-md-5 d-flex">
    <div class="card character-bio w-100">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="infoTab-{{ $image->id }}" data-toggle="tab" href="#info-{{ $image->id }}" role="tab">Info</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="notesTab-{{ $image->id }}" data-toggle="tab" href="#notes-{{ $image->id }}" role="tab">Notes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="creditsTab-{{ $image->id }}" data-toggle="tab" href="#credits-{{ $image->id }}" role="tab">Credits</a>
                </li>
                @if (isset($showMention) && $showMention)
                    <li class="nav-item">
                        <a class="nav-link" id="mentionTab-{{ $image->id }}" data-toggle="tab" href="#mention-{{ $image->id }}" role="tab">Mention</a>
                    </li>
                @endif
                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <li class="nav-item">
                        <a class="nav-link" id="settingsTab-{{ $image->id }}" data-toggle="tab" href="#settings-{{ $image->id }}" role="tab"><i class="fas fa-cog"></i></a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="card-body tab-content">
            <div class="text-right mb-1">
                <div class="badge badge-primary">Image #{{ $image->id }}</div>
            </div>
            @if (!$image->character->is_myo_slot && !$image->is_valid)
                <div class="alert alert-danger">
                    This version of this {{ __('lorekeeper.character') }} is outdated, and only noted here for recordkeeping purposes. Do not use as an official reference.
                </div>
            @endif
            @if ($image->label)
                <div class="alert alert-info">
                    {{ config('lorekeeper.character_labels')[$image->label['label']] }}
                    {!! $image->label['label_information'] ? '<br /> Description: ' . $image->label['label_information'] : null !!}
                </div>
            @endif

            {{-- Basic info --}}
            <div class="tab-pane fade show active" id="info-{{ $image->id }}">
                <div class="row no-gutters">
                    <div class="col-lg-4 col-5">
                        <h5>Species</h5>
                    </div>
                    <div class="col-lg-8 col-7 pl-1">{!! $image->species_id ? $image->species->displayName : 'None' !!}</div>
                </div>
                @if ($image->subtype_id)
                    <div class="row no-gutters">
                        <div class="col-lg-4 col-5">
                            <h5>Subtype</h5>
                        </div>
                        <div class="col-lg-8 col-7 pl-1">{!! $image->subtype_id ? $image->subtype->displayName : 'None' !!}</div>
                    </div>
                @endif
                @if ($image->transformation_id)
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4">
                            <h5>{{ ucfirst(__('transformations.form')) }} {!! add_help('The main image is always the active image') !!}</h5>
                        </div>
                        <div class="col-lg-8 col-md-6 col-8">
                            <a href="{{ $image->transformation->url }}">
                                {!! $image->transformation->displayName !!}
                            </a>
                            @if($image->transformation_description) ({{ $image->transformation_description }}) @endif
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-4">
                        <h5>Rarity</h5>
                    </div>
                    <div class="col-lg-8 col-7 pl-1">{!! $image->rarity_id ? $image->rarity->displayName : 'None' !!}</div>
                </div>
                @if ($image->sex)
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4">
                            <h5>Sex</h5>
                        </div>
                        <div class="col-lg-8 col-md-6 col-8">{!! $image->sex !!}</div>
                    </div>
                @endif
                @if (config('lorekeeper.character_pairing.colours'))
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4">
                            <h5>
                                Colours
                                @if ($image->character->is_myo_slot)
                                    {!! add_help('These colours are created from the parents of the MYO slot. They are not editable until the MYO is created.') !!}
                                @endif
                            </h5>
                        </div>
                        <div class="col-lg-8 col-md-6 col-8">
                            @if ($image->colours)
                                <div class="{{ $image->character->is_myo_slot ? '' : 'row' }}">
                                    {!! $image->displayColours() !!}
                                    @if (Auth::check() && Auth::user()->hasPower('manage_characters') && !$image->character->is_myo_slot)
                                        <div class="btn btn-outline-info btn-sm edit-image-colours ml-3 py-0" data-id="{{ $image->id }}">Edit</div>
                                    @endif
                                </div>
                                @if (Auth::check() && Auth::user()->hasPower('manage_characters') && !$image->character->is_myo_slot)
                                    <div class="collapse" id="colour-collapse-{{ $image->id }}">
                                        @include('character.admin._edit_image_colours', ['image' => $image])
                                    </div>
                                @endif
                            @else
                                <div class="row">
                                    <div>No colours listed.</div>
                                    @if (Auth::check() && Auth::user()->hasPower('manage_characters') && !$image->character->is_myo_slot)
                                        {!! Form::open(['url' => 'admin/character/image/' . $image->id . '/colours']) !!}
                                        {!! Form::submit('Generate', ['class' => 'btn btn-outline-info btn-sm ml-3 py-0']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                </div>
                            @endif
                @if ($image->titles->count() > 0)
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-4">
                            <h5>Titles</h5>
                        </div>
                        <div class="col-lg-8 col-md-6 col-8">
                            <div class="h5">
                                {!! $image->displayTitles !!}
                            </div>
                            @endif
                        </div>
                    </div>
                @endif

                <div class="mb-3">
                    <div>
                        <h5>Traits</h5>
                    </div>
                    @if (config('lorekeeper.extensions.traits_by_category'))
                        <div>
                            @php
                                $traitgroup = $image
                                    ->features()
                                    ->get()
                                    ->groupBy('feature_category_id');
                            @endphp
                            @if ($image->features()->count())
                                @foreach ($traitgroup as $key => $group)
                                    <div class="mb-2">
                                        @if ($key)
                                            <strong>{!! $group->first()->feature->category->displayName !!}:</strong>
                                        @else
                                            <strong>Miscellaneous:</strong>
                                        @endif
                                        @foreach ($group as $feature)
                                            <div class="ml-md-2">{!! $feature->feature->displayName !!} @if ($feature->data)
                                                    ({{ $feature->data }})
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            @else
                                <div>No traits listed.</div>
                            @endif
                        </div>
                    @else
                        <div>
                            <?php $features = $image
                                ->features()
                                ->with('feature.category')
                                ->get(); ?>
                            @if ($features->count())
                                @foreach ($features as $feature)
                                    <div>
                                        @if ($feature->feature->feature_category_id)
                                            <strong>{!! $feature->feature->category->displayName !!}:</strong>
                                            @endif {!! $feature->feature->displayName !!} @if ($feature->data)
                                                ({{ $feature->data }})
                                            @endif
                                    </div>
                                @endforeach
                            @else
                                <div>No traits listed.</div>
                            @endif
                        </div>
                    @endif
                </div>
                <div>
                    <strong>Uploaded:</strong> {!! pretty_date($image->created_at) !!}
                </div>
                <div>
                    <strong>Last Edited:</strong> {!! pretty_date($image->updated_at) !!}
                </div>

                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-info btn-sm edit-features mb-3" data-id="{{ $image->id }}"><i class="fas fa-cog"></i> Edit</a>
                    </div>
                @endif

                <div class="mb-1">
                    <div>
                        <h5>Pets</h5>
                    </div>
                    <div class="row justify-content-center text-center">
                        {{-- get one random pet --}}
                        @php
                            $pets = $image->character
                                ->pets()
                                ->orderBy('sort', 'DESC')
                                ->limit(config('lorekeeper.pets.display_pet_count'))
                                ->get();
                        @endphp
                        @foreach ($pets as $pet)
                            @if (config('lorekeeper.pets.pet_bonding_enabled'))
                                @include('character._pet_bonding_info', ['pet' => $pet])
                            @else
                                <div class="ml-2 mr-3">
                                    <img src="{{ $pet->pet->image($pet->id) }}" style="max-width: 75px;" />
                                    <br>
                                    <span class="text-light badge badge-dark" style="font-size:95%;">{!! $pet->pet_name !!}</span>
                                </div>
                            @endif
                        @endforeach
                        <div class="ml-auto float-right mr-3">
                            <a href="{{ $character->url . '/pets' }}" class="btn btn-outline-info btn-sm">View All</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Image notes --}}
            <div class="tab-pane fade" id="notes-{{ $image->id }}">
                @if ($image->parsed_description)
                    <div class="parsed-text imagenoteseditingparse">{!! $image->parsed_description !!}</div>
                @else
                    <div class="imagenoteseditingparse">No additional notes given.</div>
                @endif
                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-info btn-sm edit-notes" data-id="{{ $image->id }}"><i class="fas fa-cog"></i> Edit</a>
                    </div>
                @endif
            </div>

            {{-- Image credits --}}
            <div class="tab-pane fade" id="credits-{{ $image->id }}">

                <div class="row no-gutters mb-2">
                    <div class="col-lg-4 col-4">
                        <h5>Design</h5>
                    </div>
                    <div class="col-lg-8 col-8">
                        @foreach ($image->designers as $designer)
                            <div>{!! $designer->displayLink() !!}</div>
                        @endforeach
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-lg-4 col-4">
                        <h5>Art</h5>
                    </div>
                    <div class="col-lg-8 col-8">
                        @foreach ($image->artists as $artist)
                            <div>{!! $artist->displayLink() !!}</div>
                        @endforeach
                    </div>
                </div>

                @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                    <div class="mt-3">
                        <a href="#" class="btn btn-outline-info btn-sm edit-credits" data-id="{{ $image->id }}"><i class="fas fa-cog"></i> Edit</a>
                    </div>
                @endif
            </div>

            @if (isset($showMention) && $showMention)
                {{-- Mention This tab --}}
                <div class="tab-pane fade" id="mention-{{ $image->id }}">
                    In the rich text editor:
                    <div class="alert alert-secondary">
                        [character={{ $character->slug }}]
                    </div>
                    @if (!config('lorekeeper.settings.wysiwyg_comments'))
                        In a comment:
                        <div class="alert alert-secondary">
                            [{{ $character->fullName }}]({{ $character->url }})
                        </div>
                    @endif
                    <hr>
                    <div class="my-2">
                        <strong>For Thumbnails:</strong>
                    </div>
                    In the rich text editor:
                    <div class="alert alert-secondary">
                        [charthumb={{ $character->slug }}]
                    </div>
                    @if (!config('lorekeeper.settings.wysiwyg_comments'))
                        In a comment:
                        <div class="alert alert-secondary">
                            [![Thumbnail of {{ $character->fullName }}]({{ $character->image->thumbnailUrl }})]({{ $character->url }})
                        </div>
                    @endif
                </div>
            @endif

            @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                <div class="tab-pane fade" id="settings-{{ $image->id }}">
                    {!! Form::open(['url' => 'admin/character/image/' . $image->id . '/settings']) !!}
                    <div class="form-group">
                        {!! Form::checkbox('is_visible', 1, $image->is_visible, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                        {!! Form::label('is_visible', 'Is Viewable', ['class' => 'form-check-label ml-3']) !!} {!! add_help('If this is turned off, the image will not be visible by anyone without the Manage Masterlist power.') !!}
                    </div>
                    <div class="form-group">
                        {!! Form::checkbox('is_valid', 1, $image->is_valid, ['class' => 'form-check-input', 'data-toggle' => 'toggle']) !!}
                        {!! Form::label('is_valid', 'Is Valid', ['class' => 'form-check-label ml-3']) !!} {!! add_help('If this is turned off, the image will still be visible, but displayed with a note that the image is not a valid reference.') !!}
                    </div>
                    @include('widgets._character_label', ['isStaff' => true])
                    <div class="text-right">
                        {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                    <hr />
                    <div class="text-right">
                        @if ($character->character_image_id != $image->id)
                            <a href="#" class="btn btn-outline-info btn-sm active-image" data-id="{{ $image->id }}">Set Active</a>
                        @endif <a href="#" class="btn btn-outline-info btn-sm reupload-image" data-id="{{ $image->id }}">Reupload Image</a> <a href="#" class="btn btn-outline-danger btn-sm delete-image"
                            data-id="{{ $image->id }}">Delete</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>

