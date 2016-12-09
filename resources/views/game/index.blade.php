@extends("layouts.page")

@section("content")

	<div class="content">
    	<h1>My Games</h1>
			<table class="table table-stripped">
				<thead>
					<tr>
            <th>Name</th>
            <th></th>
					</tr>
				</thead>
				@foreach($games as $game)
					<tr>
						<td>{!! $game["name"] !!}</td>
            <td><a href="{!! $game->getSlug() !!}" class="btn btn-success">Enter Game</a></td>
					</tr>
	      @endforeach
			</table>
			<a href="{!! url("game/new") !!}" class="btn btn-info">+ New Game</a>
	</div>
@endsection
