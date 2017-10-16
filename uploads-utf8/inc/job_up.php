<?php
require_once(dirname(__FILE__).'/../config.inc.php');
?>
<html>
<head>
<style>
body{font-size:12px; bgcolor:menu;}
table{font-size:12px;}
</style>
<title>文件上传</title>
<meta http-equiv="content-stype" content="text/html; charset=<?php echo $cfg['charset'];?>" />
<script type="text/javascript" src="../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../js/ajaxfileupload.js"></script>
<script type="text/javascript">
	function ajaxFileUpload()
	{
		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			{
				url:'do_ajax_file_upload.php',
				secureuri:false,
				fileElementId:'fileToUpload',
				dataType: 'json',
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							alert(data.error);
						}else
						{
                            window.opener.document.<?php echo $fromForm;?>.<?php echo $fromEdit;?>.value=data.msg;
                            alert('上传成功！');
                            window.close();
						}
					}
				},
				error: function (data, status, e)
				{
					alert(e);
				}
			}
		)
		
		return false;

	}
</script>
</head>
<body bgcolor="#EEEEEE" style="margin-top: 10px; margin-left: 10px; ">
<center>
<div id="loading" style="z-index: 9999; display:none; position:absolute; text-align: center;width:100%;height:100px;">上传中，请稍后……<br /><br /><img src="../images/loading.gif" /></div>
<fieldset>
<legend align="left">文件上传</legend>
<form name="form" action="" method="POST" enctype="multipart/form-data">
请选择要上传的文件:
<input type="file" name="fileToUpload" size="20" id="fileToUpload" />
<br />
<br />允许上传的文件类型:gif,jpg,jpge,png,swf
<br />
<br />
<input type="button" name="Button01" value="上 传" onclick="return ajaxFileUpload();" />&nbsp;
<input type="reset" name="Button02"  value="重 置" />&nbsp;
<input type="button" name="Button03"  value="关 闭" onclick="javascript:window.close();" />
</form>
</fieldset>
</center>
</body>
</html>
