<?php echo $header; ?>

<div class='user_name'><?php echo $categoryName ?></div>

<div style='margin-top: 10px; font-family: Calibri;'>
<div style="overflow: hidden">
<div style="width: 30%; float: left; margin-left: 20px">
<div style="background-color: #eeeeee;">
<div style="text-align: center; color: #41A1B1; font-size: 14pt;">
Недавно добавленные цели в эту категорию
</div>
<div style="margin-left: 10px; color: #79A7AF">
	<ol>
		<li>Вася Пупкин хочет покататься на скейте</li>
		<li>Вася Пупкин хочет покататься на скейте</li>
		<li>Вася Пупкин хочет покататься на скейте</li>
		<li>Вася Пупкин хочет покататься на скейте</li>
		<li>Вася Пупкин хочет покататься на скейте</li>
	</ol>
</div>
</div>

<div style="background-color: #dedede;">
<div style="text-align: center; color: #41A1B1; font-size: 14pt;">
Недавно достигнутые цели из этой категории
</div>
<div style="margin-left: 10px; color: #79A7AF">
	<ol>
		<li>Вася Пупкин выполнил покататься на скейте</li>
		<li>Вася Пупкин выполнил покататься на скейте</li>
		<li>Вася Пупкин выполнил покататься на скейте</li>
		<li>Вася Пупкин выполнил покататься на скейте</li>
		<li>Вася Пупкин выполнил покататься на скейте</li>
	</ol>
</div>
</div>

</div>

<div style='float: left; width: 60%; margin-left: 10px;'>
<ol class='achivment_category_list'>
    <?php foreach($achivments as $achivment): ?>
        <li><a href='/Achivment/<?php echo $achivment['ID']?>'><?php echo $achivment['Name'] ?></a></li>
    <?php endforeach; ?>
</ol>


</div>
</div>
</div>


</div>


			<div style="width: 100%; height: 50px;"></div>
			</div>

			</div>		
</div>
</div>
</body>
</html>