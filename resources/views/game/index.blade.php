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
            <td><a href="{!! $game->getUrl() !!}}" class="btn btn-success"></td>
					</tr>
	      @endforeach
			</table>

	</div>
@endsection
