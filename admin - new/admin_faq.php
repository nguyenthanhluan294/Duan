<table height="28" cellSpacing="0" cellPadding="0" width="100%" border="0">
      <tr align=center>
        <td class="title" width="100%">T&#432; v&#7845;n : <a href="./?act=faq_m&page=<? echo $_REQUEST['page']?>&cat=<? echo $_REQUEST['cat']; ?>"><font class="V10pt" color="#ffffff">Nh&#7853;p M&#7899;i</font></a>&nbsp;&nbsp;
	</td>
      </tr>
    </table>
<?
	switch ($_GET['action'])
	{
		case 'del' :
			$id = $_GET['id'];
			$result = mysql_query("delete from faq where faq_id='".$id."'",$con);
			if ($result) 
				echo "<p align=center class='err'>&#272;� x�a th�nh c�ng</p>";
			else
				echo "<p align=center class='err'>Kh�ng th&#7875; x�a d&#7919; li&#7879;u</p>";
			break;
	}
?>
 
<?
	if (isset($_POST['ButDel'])) {
		$cnt=0;
		foreach ($_POST['chk'] as $id)
		{
			@$result = mysql_query("delete from faq where faq_id='".$id."'",$con);
			if ($result) $cnt++;
		}
		echo "<p align=center class='err'>&#272;� x�a ".$cnt."</p>";
	}
?>

<?
	$page = $_GET["page"];
	$p=0;
	if ($page!='') $p=$page;
	$where="1=1";
	if ($_REQUEST['status']!='') $where="faq_status=".$_REQUEST['status']." ";
	if ($_REQUEST['cat']!='') $where.=" and faq_categoriesid=".$_REQUEST['cat'];
?>
<form method="POST" name="frmList" action="index.php">
<input type=hidden name="page" value="<? echo $_REQUEST['page']; ?>">
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
	$pageindex=taotrang("select count(*) from faq where $where","./?act=".$_REQUEST['act']."&status=".$_REQUEST['status']."&cat=".$_REQUEST['cat']."&sortby=".$_REQUEST['sortby']."&direction=".$_REQUEST['direction']."&page=",$MAXPAGE,$page);
?>

<table cellspacing="0" cellpadding="0" width="100%">
<? if ($_REQUEST['code']==1) echo '<tr><td colspan=2 align="center" class="err">&#272;� c&#7853;p nh&#7853;t th�nh c�ng</td></tr>'; ?>
<tr>
<td class="smallfont">Trang : <? echo $pageindex; ?></td>
<td height="30" align="right" class="smallfont">
	<select size="1" name="ddCat" class="smallfont">
<?
	$result = mysql_query("select * from faq_categories",$con);
	echo '<option value="">[T&#7845;t c&#7843;]</option>';
	while(($row=@mysql_fetch_assoc($result)))
		if ($row['categories_id']!=$_REQUEST['cat'])
			echo '<option value="'.$row['categories_id'].'">'.$row['categories_name'].'</option>';
		else
			echo '<option selected value="'.$row['categories_id'].'">'.$row['categories_name'].'</option>';
?>
	</select> 
	<input type="button" value="Chuy&#7875;n" class="button" onclick="window.location='./?act=<? echo $_REQUEST['act']; ?>&status=<? echo $_REQUEST['status']; ?>&cat='+ddCat.value">
	</td>
</tr>
</table>
<?
function GetLinkSort($order)
{
	$direction="";
	if ($_REQUEST['direction']==''||$_REQUEST['direction']!='0')
		$direction="0";
	else
		$direction="1";
	
	return "./?act=".$_REQUEST['act']."&cat=".$_REQUEST['cat']."&page=".$_REQUEST['page']."&sortby=".$order."&direction=".$direction;
}
?>

<table border="1" cellpadding="2" style="border-collapse: collapse" bordercolor="#C9C9C9" width="100%" id="AutoNumber1">
  <tr>
    <td align=center nowrap class="title"><input type="checkbox" name="chkall" onclick="chkallClick(this);"></td>
    <td colspan="2" nowrap class="title">&nbsp;</td>
    <td align="center" nowrap class="title"><a class="title" href="<? echo GetLinkSort(1); ?>"><b>M�</b></a></td>
    <td align="center" nowrap class="title"><a class="title" href="<? echo GetLinkSort(2); ?>"><b>T�n c�u h&#7887;i</b></a></td>
    <td align="center" nowrap class="title"><a class="title" href="<? echo GetLinkSort(3); ?>"><b>H&#7885; t�n</b></a></td>
    <td align="center" nowrap class="title"><a class="title" ><b>Gi&#7899;i t�nh</b></a></td>
    <td align="center" nowrap class="title"><a class="title" href="<? echo GetLinkSort(5); ?>"><b>Email</b></a></td>    
    <td align="center" nowrap class="title"><a class="title" href="<? echo GetLinkSort(6); ?>"><b>Kh�ng hi&#7879;n</b></a></td>
    <td align="center" nowrap class="title"><a class="title" href="<? echo GetLinkSort(7); ?>"><b>Th&#7913; t&#7921;</b></a></td>
    <td align="center" nowrap class="title"><a class="title" href="<? echo GetLinkSort(8); ?>"><b>Ng�y</b></a></td>
    <td align="center" nowrap class="title"><a class="title" href="<? echo GetLinkSort(9); ?>"><b>Danh m&#7909;c</b></a></td>
  </tr>
  
  <?
  			$sortby="order by 1";
  			if ($_REQUEST['sortby']!='') $sortby="order by ".(int)$_REQUEST['sortby'];
  			$direction=($_REQUEST['direction']==''||$_REQUEST['direction']=='0'?"desc":"");
           	$sql="select * from faq where $where $sortby $direction limit ".($p*$MAXPAGE).",".$MAXPAGE;
        	$result=mysql_query($sql,$con);
        	$i=0;
           	while(($row=mysql_fetch_array($result)))
			{
			$i++;
			if ($i%2) $color="#d5d5d5"; else $color="#e5e5e5";
  ?>
  
  <tr>
    <td align="center" bgcolor="<? echo $color; ?>" class="smallfont">
    <input type="checkbox" name="chk[]" value="<? echo $row['faq_id']; ?>"></td>
    <td align="center" bgcolor="<? echo $color; ?>" class="smallfont">
    <a href="./?act=faq_m&cat=<? echo $_REQUEST['cat']; ?>&status=<? echo $_REQUEST['status']; ?>&id=<? echo $row['faq_id']; ?>&page=<? echo $_REQUEST['page'];?>">S&#7917;a</a></td>
    <td align="center" bgcolor="<? echo $color; ?>" class="smallfont">
    <a onclick="return confirm('B&#7841;n c� ch&#7855;c ch&#7855;n mu&#7889;n xo� ?');" href="./?act=<? echo $_REQUEST['act']; ?>&status=<? echo $_REQUEST['status']; ?>&action=del&cat=<? echo $_REQUEST['cat']; ?>&id=<? echo $row['faq_id']; ?>">X�a</a></td>
    <td bgcolor="<? echo $color; ?>" align="left" align="left" class="smallfont"><? echo $row['faq_id']; ?>&nbsp;</td>
    <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['faq_nameqa']; ?>&nbsp;</td>
    <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['faq_name']; ?>&nbsp;</td>
    <td bgcolor="<? echo $color; ?>" class="smallfont"><? if($row['faq_gioitinh']==0){ echo "N&#7919;";} else { echo "Nam";} ?>&nbsp;</td>
    <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['faq_email']; ?>&nbsp;</td>
    <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['faq_status']; ?>&nbsp;</td>
    <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['faq_sortorder']; ?>&nbsp;</td>    
    <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo date('d/m/Y',strtotime($row['faq_dateadded'])); ?>&nbsp;</td>
    <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['faq_categoriesid']; ?>&nbsp;</td>
  </tr>
  <?
              	}
  ?>
</table>
&nbsp;<input type="hidden" name="act" value="<? echo $_REQUEST['act']; ?>"><table border="0" width="100%" cellspacing="0" cellpadding="0" id="table1">
	<tr>
		<td>
<input type="submit" value="X�a Ch&#7885;n" name="ButDel" onclick="return confirm('B&#7841;n c� ch&#7855;c ch&#7855;n mu&#7889;n xo� ?');" class="button"></td>
		<td align="right">
&nbsp;</td>
	</tr>
</table>
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