<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>EmployeesManagement - @yield('title')</title>

    <!-- Bootstrap読み込み（スタイリングのため） -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript" language="javascript"></script>
    <script type="text/javascript">
        //// datapirckerのフォーマット変更
        $(function() {
            $("#datepicker").datepicker();
            $('#datepicker').datepicker("option", "dateFormat", 'yy/mm/dd' );
            $('#datepicker .date').datepicker({
                language: 'ja'
            });
        });
    </script>
</head>
<body>
<div class="container">
    <h1>mail list</h1>
    <div class="conttainer">
        <table class="table table-striped table-bordered">
            <tr>
                <th class="col-xs-2">id</th>
                <th class="col-xs-2">mail address</th>
                <th class="col-xs-2">送信・更新・削除</th>
            </tr>
            @foreach($mails as $row)
                <tr>
                    <td>{{ $row['id'] }}</td>
                    <td>{{ $row['address'] }}</td>
                    <td>
                        <input class="btn btn-secondary" type="button" onclick="location.href='{{route('admin.get.delete', ['id' => $row['id']])}}'" value="送信">
                        <input class="btn btn-secondary" type="button" onclick="location.href='{{route('admin.get.update', ['id' => $row['id']])}}'" value="更新">
                        <input class="btn btn-secondary" type="button" onclick="location.href='{{route('admin.get.delete', ['id' => $row['id']])}}'" value="削除">
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
</html>