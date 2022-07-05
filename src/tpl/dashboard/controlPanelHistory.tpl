<div class="container">	 
	<table border="0">
		<tr class="bidderUIHeaderRow">
			<td>onOff</td>
			<td>dailyBudget</td>
			<td>datetime</td>
			<td>by</td>
		</tr>
		{foreach from=$history item=row}
			<tr class="bidderUIRow">
				<td align="center">
					{if $row.onOff}
						<img border="0"
							src="/images/circles/greenCircle16x16.png"
							title="On"
						>
					</td>
					{else}
						<img border="0"
							src="/images/circles/redCircle16x16.png"
							title="Off"
						/>
					{/if}
				</td>
				<td align="right">
					{$row.dailyBudget}
				</td>
				<td align="right">
					{$row.datetime}
				</td>
				<td align="right">
					{$row.updatedBy}
				</td>
			</tr>
		{/foreach}
	</table>
</div>
