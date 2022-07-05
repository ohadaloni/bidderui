<div class="container">	 
	WhiteLists
	<br />
	<br />
	<table>
		<tr class="bidderUIHeaderRow">
			<td>name</td>
			<td>domains</td>
			<td colspan="3">
				<a href="/whiteLists/newWhiteList"><img
					src="/images/new.png"
					title="New WhiteList"
				/></a>
			</td>
		<tr>
		{foreach from=$rows item=row}
			<tr class="bidderUIRow">
				<td>{$row.name}</td>
				<td>
					<a target="_blank" href="/whiteLists/items">{$row.items}</a>
				</td>
				<td>
					<a href="/whiteLists/edit?id={$row.id}"><img
						border="0"
						src="/images/edit.png"
						title="edit"
					></a></td>
				</td>
			</tr>
		{/foreach}
	</table>
</div>
