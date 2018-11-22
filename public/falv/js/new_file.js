$(function(){
	
	$(".btn_1").click(function(){
		var arr = [];
		$("#box input").each(function(i){
			 arr.push($(this).val());
			 if(arr == ''){
				layer.open({
	            content: '请填写信息',
	            style: 'background:rgba(0,0,0,0.6); color:#fff; border:none;',
	            time:3
	           });
	           return false;
			}
		});
//		console.log(arr);
//      alert(arr);
});

});
