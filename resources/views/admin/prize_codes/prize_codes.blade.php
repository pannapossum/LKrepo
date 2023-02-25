@extends('admin.layout')

@section('admin-title') Prize Keys @endsection

@section('admin-content')
{!! breadcrumbs(['Admin Panel' => 'admin', 'Prize Keys' => 'admin/prizes']) !!}

<h1>Prize Keys</h1>

<p>Prize keys can be used to grant a user specified items when inputted.</p>

<div class="text-right mb-3"> 
    <a class="btn btn-primary" href="{{ url('admin/prizecodes/create') }}"><i class="fas fa-plus"></i> Create New Key</a>
</div>

@if(!count($prizes))
    <p>No prizes found.</p>
@else
    {!! $prizes->render() !!}
    <table class="table table-sm prize-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Code</th>
                <th>Generated by</th>
                <th>Starts</th>
                <th>Ends</th>
                <th>Use Limit</th>
                <th>Active?</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($prizes as $prize)
                <tr class="sort-item" data-id="{{ $prize->id }}">
                    <td> {{ $prize->name }}</td>
                    <td>{{ $prize->code }}</td>
                    <td>{!! $prize->user->displayName !!}</td>
                    <td> {!! $prize->start_at ? pretty_date($prize->start_at) : '-' !!}</td>
                    <td>{!! $prize->end_at ? pretty_date($prize->end_at) : '-' !!}</td>
                    <td> {{ $prize->use_limit ? $prize->nameWithCode : 'Unlimited' }}</td> 
                    <td>{!! $prize->active() ? '<i class="text-success fas fa-check"></i>' : '' !!}</td>
                    <td class="text-right">
                      <a href="{{ url('admin/prizecodes/edit/'.$prize->id) }}"  class="btn btn-primary py-0 px-2">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $prizes->render() !!}
    <div class="text-center mt-4 small text-muted">{{ $prizes->total() }} result{{ $prizes->total() == 1 ? '' : 's' }} found.</div>
@endif

@endsection
