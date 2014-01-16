<?php echo $header; ?>

<div style="margin-top: 20px; width: 100%; height: 300px">
    
<?php foreach ($categories as $category): ?>    
<div style="float: left; width: 31%; text-align: center; height: 300px; background-color: #fdeeee; margin: 0 10px; padding-top: 10px">
    <a href="/ListOfAchivments/<?php echo $category['URL']?>"><img width="200" src="/static/images/<?php echo $category['Image'] ?>.jpg"></a>
<div style="font-size: 28px; font-family: Calibri; font-weight: bold; color: #31859C; margin-top: 20px"><a style="text-decoration: none; <?php echo $category['Style']?>" href="/ListOfAchivments/<?php echo $category['URL']?>">
    <?php echo $category['Name']?></a></div>
</div>
<?php endforeach;?>

</div>


<div style='margin-top: 20px; padding-bottom: 20px'>

<div class="boxB" id="blog-feed">
	    		<header><h1>Latest news from our blog</h1></header>
	    										
					
	    		<article>
	    			<time datetime="2013-28-06">28.06.13 </time> <h2 class="post-title"><a href="http://www.aspire-leadership.co.uk/2013/06/values-and-the-art-of-influencing/">Values and the Art of Influencing</a></h2>
	    			<p class='post-text'>It’s rare that a (training) day goes by when I don’t mention my old friend Aristotle and his words of wisdom on Influencing &amp; Persuading &ndash; see my earlier post... <a class="more-link" href="http://www.aspire-leadership.co.uk/2013/06/values-and-the-art-of-influencing/">Read More</a></p>
	    		</article>
	    			
	    		<article>
	    			<time datetime="2013-10-06">10.06.13 </time> <h2 class="post-title"><a href="http://www.aspire-leadership.co.uk/2013/06/building-business-relationships/">Building Business Relationships</a></h2>
	    			<p class='post-text'>I was listening to the radio this morning and happened to hit on a discussion about unsolicited phone calls &ndash; you know the ones: “Mrs Forbes I hear someone in... <a class="more-link" href="http://www.aspire-leadership.co.uk/2013/06/building-business-relationships/">Read More</a></p>
	    		</article>
	    			
	    	</div>

			</div>
			</div>
			<div style="width: 100%; height: 50px; backg"></div>
			</div>		
</div>
</div>
</body>
</html>