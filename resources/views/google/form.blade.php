
		<form url = '{{ route('youtube') }}' method ='GET'>
			<div class="form-group">
				<input type="hidden" name="keyword" value="{{ $keyword }}">
				@php $p = $videos['p']>5?$videos['p']-5:1 @endphp
				@for($i=0;$i<10;$i++)
					<button name = 'pagir' value="{{ $p }}" type="submit">
					<font size="2">{{ $p }}</font>
				@php $p++ @endphp
				@endfor
				</button>
			</div>
		</form>
