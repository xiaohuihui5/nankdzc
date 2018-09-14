<?php 
	require('./inc/xc_c.php');
	$sql = "select a.icon,a.menuid,a.layer,a.title,a.url,a.target,description from sys_menu a,sys_menuright b where a.menuid<300 and a.level=1 and b.empid=".$_SESSION['empid']." and a.menuid=b.menuid and a.display=1 order by a.topmenuid";
	$result = sqlsrv_query($conn,$sql);
	while($arr=sqlsrv_fetch_array($result)){
?>
	<dl id="menu-article">
		<dt onclick="dl(this)"><i class="Hui-iconfont"><?php echo $arr['icon'];?></i> <?php echo $arr['title'];?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
		<dd <?php echo $arr['description'];?>>
			<ul>
				<?php 
					$sql1 = "select a.icon,a.menuid,a.layer,a.title,a.url,a.target from sys_menu a,sys_menuright b where a.menuid<300 and a.top_id=".$arr['menuid']." and b.empid=".$_SESSION['empid']." and a.menuid=b.menuid and a.display=1 order by a.topmenuid";
					$result1 = sqlsrv_query($conn,$sql1);
					while($arr1=sqlsrv_fetch_array($result1)){
						$sql2 = "select a.icon,a.menuid,a.layer,a.title,a.url,a.target from sys_menu a,sys_menuright b where a.menuid<300 and a.top_id=".$arr1['menuid']." and b.empid=".$_SESSION['empid']." and a.menuid=b.menuid and a.display=1 order by a.topmenuid";
						$result2 = sqlsrv_query($conn,$sql2);
						$arr2=sqlsrv_fetch_array($result2);
						if($arr2){
				?>
					<dt><i class="Hui-iconfont"><?php echo $arr1['icon'];?></i> <?php echo $arr1['title'];?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
						<?php 
							$sql2 = "select a.menuid,a.layer,a.title,a.url,a.target from sys_menu a,sys_menuright b where a.menuid<300 and a.top_id=".$arr1['menuid']." and b.empid=".$_SESSION['empid']." and a.menuid=b.menuid and a.display=1 order by a.topmenuid";
						$result2 = sqlsrv_query($conn,$sql2);
						while($arr2=sqlsrv_fetch_array($result2)){
						?>
							<li><a title="<?php echo $arr2['title'];?>" target="Navlist" href="<?php echo $arr2['url'];?>"><?php echo $arr2['title'];?></a></li>
							<?php }?>
						</ul>
					</dd>
				<?php }else{?>
				
					<li><a title="<?php echo $arr1['title'];?>" target="Navlist" href="<?php echo $arr1['url'];?>"><?php echo $arr1['title'];?></a></li>
				<?php }?>
				<?php }?>
			</ul>
		</dd>
	</dl>
<?php }?>