@extends('admin.layout')

@section('admin-title') Character Categories @endsection

@section('admin-content')
{!! breadcrumbs(['Admin Panel' => 'admin', 'Character Categories' => 'admin/data/character-categories', ($category->id ? 'Edit' : 'Create').' Category' => $category->id ? 'admin/data/character-categories/edit/'.$category->id : 'admin/data/character-categories/create']) !!}

<h1>{{ $category->id ? 'Edit' : 'Create' }} Category
    @if($category->id)
        <a href="#" class="btn btn-danger float-right delete-category-button">Delete Category</a>
    @endif
</h1>

{!! Form::open(['url' => $category->id ? 'admin/data/character-categories/edit/'.$category->id : 'admin/data/character-categories/create', 'files' => true]) !!}

<h3>Basic Information</h3>

<div class="form-group">
    {!! Form::label('Name') !!}
    {!! Form::text('name', $category->name, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Code') !!} {!! add_help('This is used in generating the codename for the character. Choose a short unique identifier, e.g. MYO, GUEST, etc.') !!}
    {!! Form::text('code', $category->code, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('Sub Masterlist (Optional)') !!} {!! add_help('This puts it onto a sub masterlist.') !!}
    {!! Form::select('masterlist_sub_id', $sublists, $category->masterlist_sub_id, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('World Page Image (Optional)') !!} {!! add_help('This image is used only on the world information pages.') !!}
    <div>{!! Form::file('image') !!}</div>
    <div class="text-muted">Recommended size: 200px x 200px</div>
    @if($category->has_image)
        <div class="form-check">
            {!! Form::checkbox('remove_image', 1, false, ['class' => 'form-check-input']) !!}
            {!! Form::label('remove_image', 'Remove current image', ['class' => 'form-check-label']) !!}
        </div>
    @endif
</div>

<div class="form-group">
    {!! Form::label('Description (Optional)') !!}
    {!! Form::textarea('description', $category->description, ['class' => 'form-control wysiwyg']) !!}
</div>

<?php
$vals = [true, false, false];
if (isset($lineageBlacklist))
{
    $vals[0] = false;
    $vals[$lineageBlacklist->complete_removal ? 2 : 1] = true;
}
?>
<h3>Lineage Blacklist</h3>
<div class="form-check mb-1">
  <label class="form-check-label">
    {!! Form::radio('lineage-blacklist', '0', $vals[0], ['class' => 'mr-1']) !!}
    No restriction. <span class="text-muted font-italic">Will have lineage as long as the species and subtype also allow it.</span>
  </label>
</div>
<div class="form-check mb-1">
  <label class="form-check-label">
    {!! Form::radio('lineage-blacklist', '1', $vals[1], ['class' => 'mr-1']) !!}
    Characters in this category can have ancestors but not descendants. <span class="text-muted font-italic">Such as mules, hybrids, children, etc.</span>
  </label>
</div>
<div class="form-check disabled mb-2">
  <label class="form-check-label">
    {!! Form::radio('lineage-blacklist', '2', $vals[2], ['class' => 'mr-1']) !!}
    Characters in this category cannot have lineages at all. <span class="text-muted font-italic">Such as locations, artifacts, etc.</span>
  </label>
</div>

<div class="text-right">
    {!! Form::submit($category->id ? 'Edit' : 'Create', ['class' => 'btn btn-primary']) !!}
</div>

{!! Form::close() !!}

@if($category->id)
    <h3>Preview</h3>
    <div class="card mb-3">
        <div class="card-body">
            @include('world._entry', ['imageUrl' => $category->categoryImageUrl, 'name' => $category->displayName, 'description' => $category->parsed_description])
        </div>
    </div>
@endif

@endsection

@section('scripts')
@parent
<script>
$( document ).ready(function() {
    $('.delete-category-button').on('click', function(e) {
        e.preventDefault();
        loadModal("{{ url('admin/data/character-categories/delete') }}/{{ $category->id }}", 'Delete Category');
    });
});

</script>
@endsection
