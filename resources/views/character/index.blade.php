@extends("layouts.page")

@section("content")

	<div class="content">
    	<h1>My Characters</h1>
			<table class="table table-stripped">
				<thead>
					<tr>
						<th> Name </th>
						<th> Race </th>
						<th> Class </th>
						<th> Skills </th>
						<th> Stats </th>
						<th></th>
					</tr>
				</thead>
				@foreach($characters as $character)
					<tr>
						<td>{!! $character["name"] !!}</td>
						<td>{!! $character["race"] !!}</td>
						<td>{!! $character["class"] !!}</td>
						<td>
							<ul>
								@foreach( $character->getSkills() as $skill)
									<li>{!! $skill["name"] !!}</li>
								@endforeach
							</ul>
						</td>
						<td>
							<ul>
								@foreach( $character->getStats() as $stat)
									<li> <strong>{!! $stat["name"] !!}</strong> {!! $stat["value"] !!}</li>
								@endforeach
							</ul>
						</td>
						<td> <a href="{!! url("character/edit?character_id=".$character->character_id) !!}" class="btn btn-info">Edit</a> </td>
					</tr>
	      @endforeach
			</table>


			<a href="{!! url('character/new') !!}" class="btn btn-success">New Character</a>
	</div>
@endsection
