<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo Yii::app()->name; ?></title>
	<style type="text/css">
		#outlook a {padding:0;}
		ReadMsgBody{ width: 100%;}
		.ExternalClass {width: 100%;}
		.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 1.5;}
		body {width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%;margin:0 !important; padding:0 !important;}
		#backgroundTable {margin:0; padding:0; width:100% !important; line-height: 1.5 !important; background-color:#e5e5e5;}
		p { margin: 1em 0;}
		table, tr, td { margin: 0; padding: 0; border: 0; font-size: 100%; font: inherit; vertical-align: baseline; }
		table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; border-spacing: 0;}
		img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;}
		a img {border:none;}
		.image_fix {display:block;}
		h1, h2, h3, h4, h5, h6 {color: #135987 !important;}
		h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: #1A7BBA !important;}
		h1 a:hover, h2 a:hover,  h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover {color: #6AC6E2 !important;}
		h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {color: #1A7BBA !important;}
		h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {color: #1A7BBA !important;}
		a:hover {color: #6AC6E2;}
		a, a:visited, a:active {color: #1A7BBA;}
		.flat_btn:hover {background: #6AC6E2 !important;text-decoration: none;}
		@-ms-viewport{ width: device-width;}
		@media only screen and (max-width: 580px) {
			table[id="sheet"] {width: 100% !important;}
			table[id="sheet"] .sidepad {display: none !important;}
			table[id="sheet"] .middle {width: 100% !important;}
			table[id="sheet"] .logo {margin: 0px auto !important;}
			table[id="sheet"] .desktop {display: none !important;}
		}
	</style>
</head>
<body style="background-color: #e5e5e5; color: #666666; margin: 0px; padding:0px; -webkit-text-size-adjust:none;">
<table id="backgroundTable" border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0; width:100% !important; line-height: 1.5 !important; background-color:#e5e5e5; color: #666666; -webkit-text-size-adjust:none;">
	<tr>
		<td><?php echo $content ?></td>
	</tr>
	<tr>
		<td><?php echo (isset($_data_['data']['message'])) ? $_data_['data']['message'] : "" ;?></td>
	</tr>
	<tr>
		<td align="center" valign="top" id="Table5" style="text-align: center; color: #444444; font-family: Arial; font-size: 14px; padding-top: 24px; line-height: 1.5;">
			This email was sent by: <a href="http://<?php echo Yii::app()->params['webUrl'];?>"><?php echo Yii::app()->name; ?></a>
		</td>
	</tr>
</table>

</body>
</html>