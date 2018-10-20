@php $p = $videos['page']>5?$videos['page']-5:1 @endphp
@for($i=$p;$i<10;$i++)
    <li class="page-item"><a class="page-link" href="{{ Request::url().'?keyword='.$keyword.'&page='.$p}}">{{ $p }}</a></li>
    @php $p++ @endphp
@endfor
