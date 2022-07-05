<div class="container">	 
	BlackLists
	<br />
	<br />
	<table>
		<tr class="bidderUIHeaderRow">
			<td>name</td>
			<td>domains</td>
			<td colspan="3">
				<a href="/blackLists/newBlackList"><img
					src="/images/new.png"
					title="New BlackList"
				/></a>
			</td>
		<tr>
		{foreach from=$rows item=row}
			<tr class="bidderUIRow">
				<td>{$row.name}</td>
				<td>
					<a target="_blank" href="/blackLists/items">{$row.items}</a>
				</td>
				<td>
					<a href="/blackLists/edit?id={$row.id}"><img
						border="0"
						src="/images/edit.png"
						title="edit"
					></a></td>
				</td>
			</tr>
		{/foreach}
	</table>
</div>
