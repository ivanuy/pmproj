@extends('layouts.main')
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <strong>Edit User</strong>
    </div>

    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id], 'files' => true]) !!}
        @include('users.form')
    {!! Form::close()!!}

</div>
@endsection