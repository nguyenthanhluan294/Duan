<table height="28" cellSpacing="0" cellPadding="0" width="100%" border="0">
      <tr align=center>
        <td class="title" width="100%" height="17">
        Tin m&#7899;i: </td>
      </tr>
    </table>
<?
	switch ($_GET['action'])
	{
		case 'del' :
			$id = $_GET['id'];
			$sql = "delete from news_hot where ns_id='".$id."'";
			@$result = mysql_query($sql,$con);
			if ($result) echo "<p align=center class='err'>&#272;� x�a th�nh c�ng</p>";
			else echo "<p align=center class='err'>Kh�ng th&#7875; x�a d&#7919; li&#7879;u</p>";
			break;
	}
?>

<?
	if (isset($_POST['ButDel'])) {
		$cnt=0;
		foreach ($_POST['chk'] as $id)
		{
			@$result = mysql_query("delete from news_hot where ns_id='".$id."'",$con);
			if ($result) $cnt++;
		}
		echo "<p align=center class='err'>&#272;� x�a ".$cnt." ph&#7847;n t&#7917;</p>";
	}
?>
<?
	$page = $_GET["page"];
	$p=0;
	if ($page!='') $p=$page;
?>
<form method="POST" action="<? echo $_SERVER[PHP_SELF]; ?>" name="frmList">
<input type=hidden name="page" value="<? echo $page; ?>">
<?
function taotrang($sql,$link,$nitem,$itemcurrent)
{	global $con;
	$ret="";
	$result = mysql_query($sql, $con) or die('Error' . mysql_error());
	$value = mysql_fetch_array($result);
	$plus = (($value['cnt'] % $nitem)>0);
	for ($i=0;$i<($value[0] / $nitem) + plus;$i++)
	{
		if ($i<>$itemcurrent) $ret .= "<a href=\"".$link.$i."\" class=\"lslink\">".($i+1)."</a> ";
		else $ret .= ($i+1)." ";
	}
	return $ret;
}
	$pageindex=taotrang("select count(*) from news_hot","./?act=news_hot&cat=".$_REQUEST['cat']."&page=",$MAXPAGE,$page);
?>

<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td class="smallfont">Trang : <? echo $pageindex; ?></td>
</tr>
</table>

<table border="1" cellpadding="2" style="border-collapse: collapse" bordercolor="#C9C9C9" width="100%" id="AutoNumber1">
  <tr>
    <td align=center nowrap class="title"><input type="checkbox" name="chkall" onclick="chkallClick(this);"></td>
    <td nowrap class="title">&nbsp;</td>
    <td nowrap class="title">&nbsp;</td>
    <td align="center" nowrap class="title"><b>M�</b></td>
    <td align="center" nowrap class="title"><b>Ti�u &#273;&#7873;</b></td>
    <td align="center" nowrap class="title"><b>Th&#7913; t&#7921; s&#7855;p x&#7871;p</b></td>
    <td align="center" nowrap class="title"><b>Kh�ng hi&#7875;n th&#7883;</b></td>
    <td align="center" nowrap class="title"><b>Ng�y</b></td>
  </tr>
  
  <?
            	$sql="select *,DATE_FORMAT(ns_dateadded,'%d/%m/%Y %h:%m') as dateformat from news_hot order by ns_id limit ".($p*$MAXPAGE).",".$MAXPAGE;
            	$result=mysql_query($sql,$con);
            	$i=0;
            	while(($row=mysql_fetch_array($result)))
				{
					$i++;
					if ($i%2) $color="#d5d5d5"; else $color="#e5e5e5";
					$proinfo=GetNewsInfo($row['news_id']);
  ?>
  
  <tr>
    <td width="20" align="center" bgcolor="<? echo $color; ?>" class="smallfont">
    <input type="checkbox" name="chk[]" value="<? echo $row['ns_id']; ?>"></td>
    <td width="20" bgcolor="<? echo $color; ?>" class="smallfont">
    <a href="./?act=news_hot_m&id=<? echo $row['ns_id']; ?>&page=<? echo $page?>">
	S&#7917;a</a></td>
    </td>
    <td width="20" bgcolor="<? echo $color; ?>" class="smallfont">
    <a onclick="return confirm('B&#7841;n c� ch&#7855;c ch&#7855;n mu&#7889;n xo� ?');" href="./?act=news_hot&action=del&page=<? echo $_REQUEST['page']; ?>&id=<? echo $row['ns_id']; ?>">
	X�a</a></td>
    <td width="20" bgcolor="<? echo $color; ?>" align="left" width="55" align="left" class="smallfont"><? echo $row['ns_id']; ?>&nbsp;</td>
    <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $proinfo['news_subject']; ?>&nbsp;</td>
    <td width="80" bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['ns_sortorder']; ?>&nbsp;</td>
    <td width="80" bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['ns_status']; ?>&nbsp;</td>
    <td width="100" bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['dateformat']; ?>&nbsp;</td>
  </tr>
  <?
              	}
  ?>
</table>
<input type="submit" value="X�a Ch&#7885;n" name="ButDel" onclick="return confirm('B&#7841;n c� ch&#7855;c ch&#7855;n mu&#7889;n xo� ?');" class="button" style="padding: 0">
<input type="hidden" name="act" value="news_hot">
</form>
<script language="JavaScript">
function chkallClick(o) {
  	var form = document.frmList;
	for (var i = 0; i < form.elements.length; i++) {
		if (form.elements[i].type == "checkbox" && form.elements[i].name!="chkall") {
			form.elements[i].checked = document.frmList.chkall.checked;
		}
	}
}
</script>