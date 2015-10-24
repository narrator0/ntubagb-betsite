<table>
	<caption>
		<stronge><label class="data-title"><?php echo $title ?></label></stronge>
		<a href="/web/manage/index.php/manageController/create<?php echo ucfirst($dataName) ?>" class="btn btn-success">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</a>
	</caption>
	<thead>
		<tr>
			<?php foreach ($sampleRowData as $key => $value) : ?>
				<th><?php echo $key ?></th>
			<?php endforeach ; ?>
			<th colspan="
			<?php 
				if ($dataName == 'cup' || $dataName == 'game')
					echo 3; 
				else 
					echo 2; 
			?>
			">
				manage
			</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data as $dataRow) : ?>
			<tr>
				<?php foreach ($dataRow as $value) : ?>
					<td><?php echo $value ?></td>
				<?php endforeach ; ?>
				<td>
					<a href="/web/manage/index.php/manageController/change<?php echo ucfirst($dataName) ?>/<?php echo $dataRow['id'] ?>">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</a>
				</td>
				<td>
					<a class="delete-btn" href="/web/manage/index.php/manageController/deleteData/<?php echo $dataName ?>/<?php echo $dataRow['id'] ?>">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a>
				</td>
				<?php
					$stringFront = "<td><a class='delete-btn' href='/web/manage/index.php/manageController/viewData/";
					$stringEnd = "'><span class='glyphicon glyphicon-circle-arrow-right' aria-hidden='true'></span></a></td>";

					if ($dataName == 'cup')
						echo $stringFront . "game/" . $dataRow['id'] . $stringEnd;
					else if ($dataName == 'game')
						echo $stringFront . "statistic/" . $dataRow['id'] . $stringEnd;
				 ?>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

