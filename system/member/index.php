<?php if($_SESSION['mem']=='' )
{?>

<?}
else{?>
<div style=" background: #f3f1f2; " class="space"></div>
<?php include("system/member/frame_tittle_member.php");?>

<div style="overflow:hidden;background-color:#FFFFFF;clear:both">
<div class="member_left">
<?php include("system/member/menu_left.php");?>
</div>
<div class="member_right">
<div style="overflow: hidden;">
<?php if($_REQUEST['member']=='')
{?>
<?}else{?>
<div style="float: left;width:210px">
<?php include("system/home/sub_cat_news.php");?>
<div class="space"></div>
<!--end email sale-->
<!--begin store vip-->
<div>
<div id="category_store">
Gian hàng Vip
</div>
<?php include("system/home/store_vip.php");?>
</div>
<!--end store vip-->
</div>
<?}?>
<div style="float: left;width: 970px;">
<?php if($_REQUEST['act']=='')
{?>
<?php include("system/member/infomation.php");?>
<?}else{?>
<?php include("system/member/frame_member.php");?>
<?}?>
</div>
</div>
</div>
</div>
<div style="height:20px;clear:both">
</div>
<?}?>




