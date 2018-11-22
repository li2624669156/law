<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>提现</title>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>
<body>
<input type="radio" value="1" name="tixian">提现到微信零钱
<input type="radio" value="2" name="tixian">提现到银行卡
<input type="radio" value="3" name="tixian">提现到支付宝
<br>
银行卡号:<input type="number" id="bankCard" value="">
<br>
姓名:<input type="text" id="name" value="">
<br>
支付宝账号: <input type="number" id="alipay" value="">
<br>
提现金额: <input type="number" id="money">
<br>
<button id="tixian">提现</button>
</body>
</html>
<script>
    $('#tixian').click(function(){
        var status = $('input:radio:checked').val();
        if(status == undefined){
            alert('请选择提现方式');
            return false;
        }
        var money = $('#money').val();
        if(money == ''){
            alert('请输入金额');
            return false;
        }
        if(money <= 0){
            alert('请输入大于0的金额');
            return false;
        }
        if(status == 1){
            if(money <= 0.3){
                alert('请输入大于0.3元的金额');
                return false;
            }
        }
        var bankCard = $('#bankCard').val();
        var name = $('#name').val();
        if(status == 2){
            if(money < 1){
                alert('请输入大于等于1元的金额');
                return false;
            }
            if(bankCard == ''){
                alert('请输入银行卡号');
                return false;
            }
            if(name == ''){
                alert('请输入姓名');
                return false;
            }
        }
        var alipay = $('#alipay').val();
        if(status == 3){
            if(money < 0.1){
                alert('请输入大于等于0.1元的金额');
                return false;
            }
            if(alipay == ''){
                alert('请输入支付宝号');
                return false;
            }
        }
        $.get('/tixian_do',{
            status:status,
            money:money,
            bankCard:bankCard,
            name:name,
            alipay:alipay
        },function(data){
            if(data ==1){
                location.href = 'person';
                alert('提现成功');
            }else if(data == 2){
                alert('您的余额不足');
            }
        })
    })
</script>