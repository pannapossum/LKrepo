<h5>Pure HTML Template</h5>

<div class="form-group">
    {!! Form::label('data[pure_html]', 'Pure HTML') !!}
    {!! Form::textarea('data[pure_html]', $template->data['pure_html'] ?? '', ['class' => 'form-control']) !!}
</div>