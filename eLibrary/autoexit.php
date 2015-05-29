


// JavaScript Document
<script src="../HMS/js/jquery-2.1.0.min.js"></script>
<script>
	var loginUrl = "test/autoexit.php";
	
	function closeWin(){
		window.opener = null;
		window.open('','_self');
		window.close();
	}
	function div(number1,number2){
		var num1 = Math.round(number1);
		var num2 = Math.round(number2);
		var result = num1/num2;
		if(result >=0){
			result = Math.floor(result);
		}else{
			result = Math.ceil(result);
		}

		return result;
	}

	function formatTime(sec){
		var re = "";
		
		var hour = div(sec, 3600);
		if(hour > 0){
			re += hour + "时";
			sec -= hour * 3600;
		}
		var min = div(sec, 60);
		if(min > 0){
			re += min + "分";
			sec -= min * 60;
		}
		
		re += sec + "秒";
		
		return re;
	}
	
	function autoCalculate(){
		currentTrained++;
		$("#currentTrainedText").html(formatTime(currentTrained));
	}
	
	function endTrain(){
		$("#logout").attr("disabled", "disabled");
		jQuery.post("/xmll/endTrain.do", {}, function(data){
			var res = eval("("+data+")");
			if(res.result != 0){
				alert(res.message);
			}
			
	closeWin();	
	
		}).error(function() { 
			alert("系统异常，将自动退出");
			
	closeWin();	
	
		});
	}
	
	function autoOut(){
		if(idleTimeRemain > 0){
			idleTimeRemain--;
			//$("#idleTimeRemainText").html(formatTime(idleTimeRemain));
			if(idleTimeRemain <= 30){
				$("#autoOutConfirm").show();
				$("#autoOutConfirmText").html(idleTimeRemain);
			}else{
				$("#autoOutConfirm").hide();
			}
			if(idleTimeRemain == 0){
				closeWin();
			}
		}
	}
	
	var wrongCount = 0;
	var isTotalFirstMsg = true;
	function autoSave(){
		var params = {};
		params.isTotalFirstMsg = isTotalFirstMsg;
		
		jQuery.post("/xmll/autoSave.do", params, function(data){
			wrongCount = 0;
			
			var res = eval("("+data+")");
			if(res.result != 0){
				if(res.result == 2){
					endTrain();
				}else if(res.result == 5){
					tipsDia("你的总学时已达标。");
					isTotalFirstMsg = false;
				}else{
					
	closeWin();	
	
				}
			}
		}).error(function() {
			wrongCount++;
			
			if(wrongCount >= 3){
				alert("网络异常，系统将自动退出");
				
	closeWin();	
	
			}
		});
	}
		
		function tipsDia(content){
		art.dialog({
			id: 'tipsDia',
			title: '友情提示',
		    content: content,
		    background: '#a6d2ed', // 背景色
		    width:'290px',
		    height:'150px',
		    icon: 'warning',
		    opacity: 0.87,	// 透明度
		    ok: function () {
		        return true;
		    },
		    cancelVal: '关闭',
		    cancel: true
		});
	}
	
	var currentTrained = 8;	var idleTime = 5 * 60;
	var idleTimeRemain = idleTime;
	
	document.onmouseup = function(){idleTimeRemain = idleTime;};
	document.onkeyup = function(){idleTimeRemain = idleTime;};
	
	$(document).ready(function () {
		$("#currentTrainedText").html(formatTime(currentTrained));
		//$("#idleTimeRemainText").html(formatTime(idleTimeRemain));
		
		var inter1 = setInterval("autoCalculate()", 1000);
		var inter2 = setInterval("autoOut()", 1000);
		var inter3 = setInterval("autoSave()", 60000);
		
		$("#logout").click(function(){
			if(confirm("本次培训总时间"+formatTime(currentTrained)+"，是否结束本次培训")){
				endTrain();
			}
		});
	});
	
</script>

<div id="autoOutConfirm" class="box"
	style="display: none; position: absolute; z-index: 999; top: 50%; left: 50%;">
	<p>
		<span id="autoOutConfirmText"></span>秒后将自动退出
	</p>
	<a href="#" onclick="$('#autoOutConfirm').hide();">不退出</a>
</div>
<form method="post" action="mailto: qianxfuture@hotmail.com" enctype="multipart/form-data"> 
<imput name=“subject” type=“hidden” value=“题目“> 
<textarea name="body">内容</textarea> 
<input type="text" name="tel "/>
<input type="submit" value="提交"> 
</form> 