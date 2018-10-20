@extends('layouts.layout')

@section('content')
<div class = 'container'>
	<div class = 'col-md-12 clearfix'>
		<div class = 'col-md-6 float-md-left test-box'>
			<h2>youtube</h2>
		</div>
		<div class = 'mh-100 col-md-6 float-md-right test-box'>
		<form url = '{{ route('youtube') }}' method = 'GET' class="form-inline">
			<div class="form-group">
				<label for="keyword">検索</label>
				<input name = 'keyword' type="text" class="form-control" id="keyword" placeholder="キーワード" size="10">
				<button type="submit" class="btn btn-primary">検索</button>
			</div>
		</form>
		</div>
	</div>
	<div class = 'col-md-10'>
		<div class = 'hoge'>
			@if(isset($keyword))
			<p>{{$keyword}}の検索結果</p>
			@endif
		</div>
	<table class="table">
		<thead>
			<tr>
				<th>サムネ</th>
				<th>チャンネル</th>
				<th>タイトル</th>
				<th>内容</th>
			</tr>
		</thead>
		<tbody>
		@foreach($videos as $video)
		@if(isset($video['id']))
			<tr class='clickable-row' data-href='https://www.youtube.com/watch?v={{ $video['id']['videoId'] }}'>
				<td><a href='https://www.youtube.com/watch?v={{ $video['id']['videoId'] }}'>
				<div class="thums">
				<img src="{{ $video['snippet']['thumbnails']['default']['url'] }}" />
				</div>
				</a>
				</td>
				<td><a href="{{ route('youtube') }}">{{ $video['snippet']['channelTitle'] }}</a></td>
				<td>{{ $video['snippet']['title'] }}</td>
				<td>{{ $video['snippet']['description'] }}</td>
			</tr>
		@endif
		@endforeach
		</tbody>
	</table>
	</div>
</div>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
	  @inclide('google.patinate')
  </ul>
</nav>


@endsection

@section('script')


@stop
