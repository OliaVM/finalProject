<?php if (isset($rubric)): ?>	
	<?php if (isset($_GET['page'])): ?>	
		<?php if ($page > 1): ?>
			<?php $backpage2 = '<a href= ./news.php?theme='.$rubric.'&page=1><<Первая страница</a>'; ?>
			<?php echo $backpage2 . " "; ?>
		<?php	endif; ?> 
		<?php if ($page > 2): ?>
		  	<?php $backpage1 = '<a href= ./news.php?theme='.$rubric.'&page='. ($page - 1) .'><Предыдущая страница</a> '; ?>
		  	<?php echo $backpage1 . " "; ?>
		<?php	endif; ?> 
		<?php echo " " .'<b>'.$page.'</b>'. " "; ?>
		
		<?php if ($page < $total): ?>
			<?php $nextpage1 = '<a href= ./news.php?theme='.$rubric.'&page='. ($page + 1) .'>Следующая страница></a>'; ?>
			<?php echo $nextpage1 . " "; ?>
		<?php	endif; ?>  
		<?php if ($page < $total-1): ?>
			<?php $nextpage2 = '<a href= ./news.php?theme='.$rubric.'&page=' .$total. '>Последняя страница>></a>'; ?>
			<?php echo $nextpage2; ?>
		<?php	endif; ?> 
	<?php	endif; ?> 	
<?php	endif; ?> 




