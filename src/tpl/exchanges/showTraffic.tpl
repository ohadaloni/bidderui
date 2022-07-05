<div class="container">
	<table>
		<tr class="bidderUIHeaderRow">
			<td align="center" colspan="11">
				Exchage simulator traffic control
			</td>
		<tr>
		<tr class="bidderUIHeaderRow">
			<td>strength</td>
			<td>kind</td>
			<td>w</td>
			<td>h</td>
			<td>geo</td>
			<td>gender</td>
			<td>ageGroup</td>
			<td align="center" colspan="3">
				<a href="/exchanges/newTraffic"><img
					src="/images/new.png"
					title="New Traffic Row"
				/></a>
			</td>
		</tr>
		{foreach from=$rows item=row}
			<tr class="bidderUIRow">
				<td>{$row.strength}</td>
				<td>{$row.kind}</td>
				<td>{$row.w}</td>
				<td>{$row.h}</td>
				<td>{$row.geo}</td>
				<td>{$row.gender}</td>
				<td>{$row.ageGroup}</td>
				<td>
					<a href="/exchanges/editTraffic?id={$row.id}"><img
						src="/images/edit.png"
						title="Edit"
					/></a>
				</td>
				<td>
					<a href="/exchanges/dupTraffic?id={$row.id}"><img
						src="/images/duplicate.png"
						title="Edit"
					/></a>
				</td>
				<td>
					<form method="get" action="/exchanges/deleteTraffic">
						<input type="checkbox" name="ok" />
						<input type="hidden" name="id" value="{$row.id}" />
						<input
							type="image"
							src="/images/delete.png"
							title="check the box to confirm deletion"
						/>
					</form>
				</td>
			</tr>
		{/foreach}
	</table>
</div>
