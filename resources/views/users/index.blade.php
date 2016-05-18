@extends('layouts.main')
@section('content')
<div class="panel panel-default">
	<table class="table">
	@foreach ($users as $user)
		<tr>
			<td class="middle">
				<div class="media">
					<div class="media-left">
						<a href="#">
							<?php $photo =!is_null($user->photo)?$user->photo: 'default.png' ?>
							{!! Html::image('uploads/' . $photo, $user->name, ['class' => 'media-object', 'width' => 100, 'height' => 100]) !!}
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading">{{ $user->name }}</h4>
						<address>
							<strong>{{ $user->phone }}</strong><br>
							{{ $user->email }}
						</address>
					</div>
				</div>
			</td>
			<td width="100" class="middle">
				<div>
					{!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id]]) !!}
					<a href=" {{ route('users.edit', ['id' => $user->id]) }} " class="btn btn-default btn-xs btn-no-border" title="Edit">
						<i class="glyphicon glyphicon-edit"></i>
					</a>
					<button href="#" class="btn btn-xs btn-remove-circle btn-link" title="Delete" >
						<i class="glyphicon glyphicon-remove-circle" style="font-size: 24px; color: #c9302c"></i>
					</button>

					{!! Form::close() !!}
				</div>
			</td>
		</tr>

	@endforeach

	</table>
</div>

<div class="text-center">
	<nav>
		<ul class="pagination">
			{!! $users->links() !!}
		</ul>
	</nav>
	<nav>
</nav>
</div>

@endsection
