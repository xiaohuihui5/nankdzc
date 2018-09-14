<?php 
	$sql = "select a.menuid,a.title from sys_menu a where a.menuid<300 and a.level=1 and a.display=1 group by a.menuid,a.title,a.topmenuid order by a.topmenuid";
	$result = sqlsrv_query($conn,$sql);
	while($arr=sqlsrv_fetch_array($result)){
?>
	<dl id="menu-article" style="background:#35a9191a;">
		<dt onclick="dl(this)"><i class="Hui-iconfont"><?php echo $arr['icon'];?></i> <?php echo $arr['title'];?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
		<dd>
			<ul>
				<?php 
					$sql1 = "select a.menuid,a.title from sys_menu a where a.menuid<300 and a.top_id=".$arr['menuid']." and a.display=1 group by a.menuid,a.title,a.topmenuid order by a.topmenuid";
					$result1 = sqlsrv_query($conn,$sql1);
					while($arr1=sqlsrv_fetch_array($result1)){
						$sql2 = "select a.menuid from sys_menu a where a.menuid<300 and a.top_id=".$arr1['menuid']." and a.display=1 group by a.menuid,a.topmenuid order by a.topmenuid";
						$result2 = sqlsrv_query($conn,$sql2);
						$arr2=sqlsrv_fetch_array($result2);
						if($arr2){
				?>
					<dt><i class="Hui-iconfont"><?php echo $arr1['icon'];?></i> <?php echo $arr1['title'];?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
					<dd>
						<ul>
						<?php 
							$sql2 = "select a.menuid,a.title from sys_menu a where a.menuid<300 and a.top_id=".$arr1['menuid']." and a.display=1 group by a.menuid,a.title,a.topmenuid order by a.topmenuid";
						$result2 = sqlsrv_query($conn,$sql2);
						while($arr2=sqlsrv_fetch_array($result2)){
						?>
							<li><a data-href="" data-title="<?php echo $arr2['title'];?>" href="javascript:void(0)" onclick="href_data(<?php echo $arr2['menuid'];?>)"><?php echo $arr2['title'];?></a></li>
							<?php }?>
						</ul>
					</dd>
				<?php }else{?>
					<li><a data-href="" data-title="<?php echo $arr1['title'];?>" href="javascript:void(0)" onclick="href_data(<?php echo $arr1['menuid'];?>)"><?php echo $arr1['title'];?></a></li>
				<?php }?>
				<?php }?>
			</ul>
		</dd>
	</dl>
<?php }?>