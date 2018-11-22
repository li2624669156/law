<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<link rel="stylesheet" href="./layui/css/layui.css">
<body>
<table border="1">
    <tr>
        <td>热点ID</td>
        <td>热点标题</td>
        <td>热点内容</td>
        <td>添加时间</td>
        <td>是否展示</td>
    </tr>
    @foreach($new_data as $k=>$v)
        <tr>
            <td>{{$v['h_id']}}</td>
            <td>{{$v['h_title']}}</td>
            <td>{{$v['h_content']}}</td>
            <td>{{$v['ctime']}}</td>
            <td>
                <input type="checkbox" name="is_show" class="show" lay-skin="switch" value="{{$v['h_id']}}" check="">
            </td>
        </tr>
    @endforeach
    <tr>
        <td>
            <input type="button" id="queren" value="确认">
        </td>
    </tr>
</table>
</body>
</html>
<script src="./layui/jquery-1.9.1.min.js"></script>
<script src="./layui/layui.js"></script>

<script>
    var a = '';
    $("#queren").click(function(){
        var a = '';
        $("#queren").click(function(){
            $('.show:checked').each(function(){
//                console.log($(this).val());
                a += $(this).val()+',';
            });
            alert(a);
            $.get("/is_show",
                {h_id:a},
                function(data){
                    console.log(data);
                    if(data == 1){
                        alert('前台展示成功');
                        window.location.href="tiao";
                    }else{
                        alert('前台展示失败');
                        window.location.href="/hot_list";
                    }
                }
            )
        })
    })

</script>