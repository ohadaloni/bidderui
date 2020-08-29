<div class="container">	 
	<table border="0">
		<tr class="bidderUIHeaderRow">
			<td>placementId</td>
			<td>bids</td>
			<td>wins</td>
			<td>winRate</td>
			<td>cost</td>
			<td>cpm</td>
			<td>views</td>
			<td>viewRate</td>
			<td>cpv</td>
			<td>clicks</td>
			<td>clickRate</td>
			<td>cpc</td>
			<td>revenue</td>
			<td>rpm</td>
			<td>profit</td>
			<td>ppm</td>
		</tr>
		{foreach from=$rows item=row}
			<tr class="bidderUIRow">
				<td>
					<a href="/reports?entity=placement&timeUnit=allTime&placementId={$row.placementId}">{$row.placementId}</a>
				</td>
				<td align="right">{$row.bids|numberFormat:0}</td>
				<td align="right">{$row.wins|numberFormat:0}</td>
				<td align="right">{$row.winRate|numberFormat:3:'%'}</td>
				<td align="right">{$row.cost|numberFormat:2:'$'}</td>
				<td align="right">{$row.cpm|numberFormat:4:'$'}</td>
				<td align="right">{$row.views|numberFormat:0}</td>
				<td align="right">{$row.viewRate|numberFormat:3:'%'}</td>
				<td align="right">{$row.cpv|numberFormat:4:'$'}</td>
				<td align="right">{$row.clicks|numberFormat:0}</td>
				<td align="right">{$row.clickRate|numberFormat:3:'%'}</td>
				<td align="right">{$row.cpc|numberFormat:4:'$'}</td>
				<td align="right">{$row.revenue|numberFormat:2:'$'}</td>
				<td align="right">{$row.rpm|numberFormat:4:'$'}</td>
				<td align="right">{$row.profit|numberFormat:2:'$'}</td>
				<td align="right">{$row.ppm|numberFormat:4:'$'}</td>
			</tr>
		{/foreach}
	</table>
</div>
