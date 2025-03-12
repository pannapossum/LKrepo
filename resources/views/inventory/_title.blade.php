<li class="list-group-item">
    <a class="card-title h5 collapse-title" data-toggle="collapse" href="#openSlotForm"> Add Title To Character</a>
    <div id="openSlotForm" class="collapse">
        {!! Form::hidden('tag', $tag->tag) !!}

        <div class="form-group">
            {!! Form::label('character_id', 'Character:', ['class' => 'form-control-label']) !!}
            {!! Form::select(
                'character_id',
                Auth::user()->characters()->get()->pluck('fullName', 'id'),
                null,
                ['class' => 'form-control'],
            ) !!}
        </div>

        @if ($tag->getData()['type'] == 'choice')
            <div class="form-group">
                {!! Form::label('title_id', 'Choose a Title:', ['class' => 'form-control-label']) !!}
                {!! Form::select('title_id', $tag->getEditData()['titles'], null, ['class' => 'form-control']) !!}
            </div>
        @endif

        <div class="text-right">
            {!! Form::button('Open', ['class' => 'btn btn-primary', 'name' => 'action', 'value' => 'act', 'type' => 'submit']) !!}
        </div>
    </div>
</li>
