<?
if (isset($_POST['butSub'])) {
 
	
	$old =   ( md5(md5(md5( md5(md5(md5( addslashes($_POST['txtOld']))))))));
	$new1 =   ( md5(md5(md5( md5(md5(md5( addslashes($_POST['txtNew']))))))));
	$new2 =   ( md5(md5(md5( md5(md5(md5( addslashes($_POST['txtNew2']))))))));
	
	if ($new1!=$new2 || $old=="" || $new1=="") echo "<p align=center><font size=2 color=red>Password ch&#432;a &#273;úng</font></p>";
	else
	{	$sql = "update user_nhanvien set pass='".$new1."' where user='".$_SESSION['user']."' and pass='".$old."'";
		if (mysql_query($sql,$con)) echo "<p align=center><font size=2 color=red>&#272;ã c&#7853;p nh&#7853;t thành công</font></p><br>";
		else echo "<p align=center><font size=2 color=red>Không th&#7875; c&#7853;p nh&#7853;t</font></p>";
	}
} 
?>

<body style="text-align: center">

<form method="POST" name="FormLoaiSP" action="index.php?act=changepass">
<input type=hidden name="oldid" value="<? echo $oldid; ?>">
<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#0069A8" width="300" id="AutoNumber1">
  <tr>
    <td width="45%" align="center" class="title" height="20">
    Thay &#273;&#7893;i m&#7853;t kh&#7849;u truy c&#7853;p</td>
  </tr>
  <tr>
    <td width="45%">
    <table border="0" cellpadding="4" bordercolor="#111111" width="389" id="AutoNumber2" cellspacing="0">
      <tr>
        <td width="33%" class="smallfont">
        <p align="right">M&#7853;t kh&#7849;u</td>
        <td width="63%" class="smallfont">
		<INPUT TYPE="password" NAME="txtOld" CLASS=textbox size="34"></td>
      </tr>
      <tr>
        <td width="33%" class="smallfont">
        <p align="right">M&#7853;t kh&#7849;u m&#7899;i</td>
        <td width="63%" class="smallfont">
		<INPUT TYPE="password" NAME="txtNew" CLASS=textbox size="34"></td>
      </tr>
      <tr>
        <td width="33%" class="smallfont">
        <p align="right">Nh&#7853;p l&#7841;i m&#7853;t kh&#7849;u m&#7899;i</td>
        <td width="63%" class="smallfont">
		<INPUT TYPE="password" NAME="txtNew2" CLASS=textbox size="34"></td>
      </tr>
      <tr>
        <td width="96%" class="smallfont" colspan="2">
		<p align="center">
		<INPUT TYPE="submit" NAME="butSub" VALUE="Thay đổi" CLASS=button>&nbsp;</td>
      </tr>
    </table>
    </td>
  </tr>
  </table>
</form>
