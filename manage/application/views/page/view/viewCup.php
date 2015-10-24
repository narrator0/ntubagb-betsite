<div class="container">
<h3 class="warning">Warning!! If you delete any cup data it will also delete all related data!!</h3>
<table>
	<caption>
		<stronge><label class="data-title"><?php echo $title ?></label></stronge>
		<a href="/web/manage/index.php/manageController/create<?php echo ucfirst($dataName) ?>" class="btn btn-success">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</a>
	</caption>
	<thead>
		<tr>
			<?php foreach ($data[0] as $key => $value) : ?>
				<th><?php echo $key ?></th>
			<?php endforeach ; ?>
			<th colspan="2">manage</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data as $dataRow) : ?>
			<tr>
				<?php foreach ($dataRow as $value) : ?>
					<td><?php echo $value ?></td>
				<?php endforeach ; ?>
				<td>
					<a href="/web/manage/index.php/manageController/change<?php echo $dataName ?>/<?php echo $dataRow['id'] ?>">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</a>
				</td>
				<td>
					<a class="delete-btn" href="/web/manage/index.php/manageController/deleteCup/<?php echo $dataRow['id'] ?>">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>



</div>