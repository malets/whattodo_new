<?php echo $header; 
$index=0;
foreach($categories as $category): ?>
<?php if($index%3 == 0){?><div style="margin-top: 20px; width: 100%; height: 300px">
    <?php }?>
<div style="float: left; width: 31%; text-align: center; height: 300px; background-color: #fdeeee; margin: 0 10px; padding-top: 10px">
<a href="/ListOfAchivments/<?php echo $category['URL']?>"><img width="200" src="/static/images/<?php echo $category['Image']?>.jpg"></a>
<div style="font-size: 28px; font-family: Calibri; color: #0070c0; margin-top: 20px; font-weight: bold">
    <a href="/ListOfAchivments/<?php echo $category['URL']?>" style="text-decoration: none; <?php echo $category['Style']?>"><?php echo $category['Name']?></a></div>
</div>
    
<?php if( ($index%3 == 2) || ($index == count($categories) - 1)){?></div>
    <?php }?>
 <?php $index++;
 endforeach;?>   





<div style='margin-top: 20px; padding-bottom: 20px'>
			</div>
</div>
			<div style="width: 100%; height: 50px;"></div>
			</div>		
</div>
</div>
</body>
</html>