<div class="list-group">
			   	<a href="" class="list-group-item list-group-item-action active">Categories</a>
			   	<!-- to do: calling categories-->
				<?php
				$result = callingquery("select * from categories");
				foreach ($result as $data):
				?>
				<a href="category.php?cat=<?= $data['cat_id'];?>" class="list-group-item list-group-item-action"><?= $data['cat_title'];?></a>
			   <?php endforeach?>
</div>