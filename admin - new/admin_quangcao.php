<table height="28" cellSpacing="0" cellPadding="0" width="100%" border="0">
      <tr align=center>
        <td class="title" width="100%">Quản lý quảng cáo
	</td>
      </tr>
    </table>
<?
	switch ($_GET['action'])
	{
		case 'del' :
			$id = $_GET['id'];
			$sql="select * from quangcao where id=$id limit 1";
        	$pro=mysql_fetch_assoc(mysql_query($sql,$con));
			$link="../";
			if ($pro)
			{
				$sql = "delete from quangcao where id='".$id."'";
				$result = mysql_query($sql,$con);
				if ($result) 
				{
					if (file_exists($link.$pro['image'])) unlink($link.$pro['image']);
					if (file_exists($link.$pro['image_large'])) unlink($link.$pro['image_large']);
					echo "<p align=center class='err'>&#272;ã xóa thành công</p>";
				}
					else echo "<p align=center class='err'>Không th&#7875; xóa d&#7919; li&#7879;u</p>";
			}
			break;
	}
?>

<?
	if (isset($_POST['ButDel'])) {
		$cnt=0;
		foreach ($_POST['chk'] as $id)
		{
			$sql="select * from quangcao where id=$id limit 1";
        	$pro=mysql_fetch_assoc(mysql_query($sql,$con));
			$link="../";
			if ($pro)
			{
				@$result = mysql_query("delete from quangcao where id='".$id."'",$con);
				if ($result) {
					$cnt++;
					if (file_exists($link.$pro['image'])) unlink($link.$pro['image']);
					if (file_exists($link.$pro['image_large'])) unlink($link.$pro['image_large']);
				}
			}
		}
		echo "<p align=center class='err'>&#272;ã xóa ".$cnt." ph&#7847;n t&#7917;</p>";
	}
?>

<?
	$page = $_GET["page"];
	$MAXPAGE=10;
	$p=0;
	if ($page!='') $p=$page;
?>
<form method="POST" name="frmList" action="">
<input type="hidden" name="act" value="quangcao">
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
	$pageindex=taotrang("select count(*) from quangcao","./?act=quangcao"."&page=",$MAXPAGE,$page);
?>

<table cellspacing="0" cellpadding="0" width="100%">
<? if ($_REQUEST['code']==1) echo '<tr><td align="center" class="err">&#272;ã c&#7853;p nh&#7853;t thành công</td></tr>'; ?>
<tr>
<td class="smallfont">Trang : <? echo $pageindex; ?></td>
</tr>
</table>

<table border="1" cellpadding="2" style="border-collapse: collapse" bordercolor="#C9C9C9" width="100%" id="AutoNumber1">
  <tr>
    <td align=center nowrap class="title"><input type="checkbox" name="chkall" onclick="chkallClick(this);"></td>
    <td colspan="2" nowrap class="title">&nbsp;</td>
    <td align="center" nowrap class="title"><b>ID</b></td>
	<td align="center" nowrap class="title"><b>User</b></td>
	  <td align="center" nowrap class="title"><b>Trạng thái</b></td>
	    <td align="center" nowrap class="title"><b>Thời gian</b></td>
		  <td align="center" nowrap class="title"><b>Loại quảng cáo</b></td>
		    <td align="center" nowrap class="title"><b>Ngày kích hoạt</b></td>
			  <td align="center" nowrap class="title"><b>Ngày hết hạn</b></td>
    <td align="center" nowrap class="title"><b>Thanh toán</b></td>
    <td align="center" nowrap class="title"><b>Banner</b></td>    
	 <td align="center" nowrap class="title"><b>ID SP</b></td>    
    <td align="center" nowrap class="title"><b>Thứ tự</b></td>
    <td align="center" nowrap class="title"><b>Ghi chú</b></td>
  </tr>
  
  <?php
           	$sql="select * from quangcao order by id limit ".($p*$MAXPAGE).",".$MAXPAGE;
        	$result=mysql_query($sql,$con);
        	$i=0;
           	while(($row=mysql_fetch_array($result)))
			{
			$i++;
			if ($i%2) $color="#d5d5d5"; else $color="#e5e5e5";
  ?>
  
  <tr>
    <td align="center" bgcolor="<? echo $color; ?>" class="smallfont">
    <input type="checkbox" name="chk[]" value="<? echo $row['id']; ?>"></td>
    <td align="center" bgcolor="<? echo $color; ?>" class="smallfont">
    <a href="./?act=suaquangcao&id=<? echo $row['id']; ?>&page=<? echo $_REQUEST['page'];?>">S&#7917;a</a></td>
    <td align="center" bgcolor="<? echo $color; ?>" class="smallfont">
    <a onclick="return confirm('B&#7841;n có ch&#7855;c ch&#7855;n mu&#7889;n xoá ?');" href="./?act=quangcao&page=<? echo $_REQUEST['page']; ?>&action=del&id=<? echo $row['id']; ?>">Xóa</a></td>
    <td bgcolor="<? echo $color; ?>" align="left" align="left" class="smallfont"><? echo $row['id']; ?>&nbsp;</td>
	<td bgcolor="<? echo $color; ?>" align="left" align="left" class="smallfont"><? echo $row['user']; ?>&nbsp;</td>
    <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['status']; ?>&nbsp;</td>
    <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['thoigian']; ?> ngày</td>

     <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['name']; ?>&nbsp;</td>
    <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['date']; ?>&nbsp;</td>
	    <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['dateend']; ?>&nbsp;</td>
		    <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['thanhtoan']; ?>&nbsp;</td>
			    <td bgcolor="<? echo $color; ?>" class="smallfont"><a  target="bank_" href="/<? echo $row['banner'];?>" ><img src="/<? echo $row['banner'];?>" width="100" height="50"></a></&nbsp;</td>
				     <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['sanpham']; ?>&nbsp;</td>
				   <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['thutu']; ?>&nbsp;</td>
					    <td width="160px"  bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['ghichu']; ?>&nbsp;</td>
  </tr>
  <?
              	}
  ?>
</table>
<input type="submit" value="Xóa Ch&#7885;n" name="ButDel" onclick="return confirm('B&#7841;n có ch&#7855;c ch&#7855;n mu&#7889;n xoá ?');" class="button">
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