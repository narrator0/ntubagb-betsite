<h1><?php echo $title ?></h1>

<table>
	<thead>
		<th>Title</th>
		<th>Link</th>
		<th colspan="2">Manage</th>	
	</thead>
	<tbody>
		<?php foreach ($videoData as $dataItem): ?>
			<tr>
				<td><?php echo $dataItem['title'] ?></td>
				<td><?php echo $dataItem['link'] ?></td>
				<td><a href="fixVideo/<?php echo $dataItem['id'] ?>">fix</a></td>
				<td><a href="">delete</a></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>




	