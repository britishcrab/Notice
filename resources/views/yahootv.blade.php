<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class = 'container'>
	<div class = 'col-md-12 clearfix'>
		<div class = 'col-md-6 float-md-left test-box'>
			<h2>yahootv</h2>
		</div>
		<div class = 'mh-100 col-md-6 float-md-right test-box'>
		<form url = '{{ route('post.yahoo.tv') }}' method = 'POST' class="form-inline">
		{{ csrf_field() }}
			<div class="form-group">
				<label for="keyword">検索</label>
				<input name = 'keyword' type="text" class="form-control" id="keyword" placeholder="キーワード" size="10">
				<button type="submit" class="btn btn-primary">検索</button>
			</div>
		</form>
		</div>
	</div>
	<div class = 'col-md-10'>
	@if(isset($keyword))
	<p>{{$keyword}}の検索結果</p>
	@endif
	<table class="table">
		<thead>
			<tr>
				<th>日付</th>
				<th>番組名</th>
				<th>内容</th>
			</tr>
		</thead>
		<tbody>
		@foreach($programs as $tr)
			<tr>
				<td>{{ $tr['day'] }}</td>
				<td><a href = "https://tv.yahoo.co.jp{{$tr['href']}}">{{ $tr['title'] }}</a></td>
				<td><a href = "https://tv.yahoo.co.jp{{$tr['href']}}">{{ $tr['content'] }}</a></td>
			</tr>
		@endforeach
		</tbody>
	</table>
	</div>
</div>
</body>
</html>
