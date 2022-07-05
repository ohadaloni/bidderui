<div class="container">	 
	<a href="/blackLists" title="blackLists"><img src="/images/arrowUp.png" />BlackLists</a>
	<br />
	<h3> {$row.name}</h3>
	<br />

	<form method="post" action="/blackLists/change">
		<table>
			<tr class="bidderUIHeaderRow">
				<td colspan="2">name</td>
			</tr>
			<tr class="bidderUIRow">
				<td>
					<input type="text" name="name" value="{$row.name}" size="40" />
				</td>
				<td align="right">
					<input type="hidden" name="blackListId" value="{$row.id}" />
					<input type="submit" value="change Name" />
				</td>
			</tr>
		</table>
	</form>
	<br />
	<br />
	<form action="/blackLists/newItem" method="post">
		<table>
			<tr class="bidderUIHeaderRow">
				<td colspan="2">New Domain for this Blacklist</td>
			</tr>
			<tr class="bidderUIRow">
				<td>
					<input type="text" name="domain" size="40" />
				</td>
				<td align="right">
					<input type="hidden" name="blackListId" value="{$row.id}" />
					<input type="submit" value="New Domain" />
				</td>
			</tr>
		</table>
	</form>
	<br />
	<br />
	<form action="/blackLists/upload" method="post" enctype="multipart/form-data">
		<table>
			<tr class="bidderUIHeaderRow">
				<td>Upload text/csv with list of Domains for this Blacklist</td>
			</tr>
			<tr class="bidderUIRow">
				<td>
					<input type="file" name="fileName" />
				</td>
				<td align="right">
					<input type="hidden" name="blackListId" value="{$row.id}" />
					<input type="submit" value="Load" />
				</td>
			</tr>
		</table>
	</form>
	<br />
	<br />
	<table>
		<tr class="bidderUIHeaderRow">
			<td>(blackclisted) domains in this list</td>
			<td></td>
		<tr>
		{foreach from=$items item=item}
			<tr class="bidderUIRow">
				<td>{$item.domain}</td>
				<td>
					<form method="get" action="/blackLists/deleteItem">
						<input type="checkbox" name="ok" />
						<input type="hidden" name="blackListId" value="{$row.id}" />
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
