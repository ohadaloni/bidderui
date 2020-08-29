<div class="container">	 
	<a href="/whiteLists" title="whiteLists"><img src="/images/arrowUp.png" />WhiteLists</a>
	<br />
	<h3> {$row.name}</h3>
	<br />

	<form method="post" action="/whiteLists/change">
		<table>
			<tr class="bidderUIHeaderRow">
				<td colspan="2">name</td>
			</tr>
			<tr class="bidderUIRow">
				<td>
					<input type="text" name="name" value="{$row.name}" size="40" />
				</td>
				<td align="right">
					<input type="hidden" name="whiteListId" value="{$row.id}" />
					<input type="submit" value="change Name" />
				</td>
			</tr>
		</table>
	</form>
	<br />
	<br />
	<form action="/whiteLists/newItem"  method="post">
		<table>
			<tr class="bidderUIHeaderRow">
				<td colspan="2">New Domain for this whitelist</td>
			</tr>
			<tr class="bidderUIRow">
				<td>
					<input type="text" name="domain" size="40" />
				</td>
				<td align="right">
					<input type="hidden" name="whiteListId" value="{$row.id}" />
					<input type="submit" value="New Domain" />
				</td>
			</tr>
		</table>
	</form>
	<br />
	<br />
	<table>
		<tr class="bidderUIHeaderRow">
			<td>domains in this list</td>
			<td></td>
		<tr>
		{foreach from=$items item=item}
			<tr class="bidderUIRow">
				<td>{$item.domain}</td>
				<td>
					<form method="get" action="/whiteLists/deleteItem">
						<input type="checkbox" name="ok" />
						<input type="hidden" name="whiteListId" value="{$row.id}" />
						<input type="hidden" name="itemId" value="{$item.id}" />
						<input
							type="image"
							src="/images/delete.png"
							title="check the box and click button to delete"
						/>
					</form>
				</td>
			</tr>
		{/foreach}
	</table>
</div>
