<div class="container">	 
	<table border="0">
		<tr class="bidderUIHeaderRow">
			<td>
				minute
				<a href="/reports?entity={$entity}&timeUnit=day&time={$drillUpTime}&campaignId={$campaignId}&placementId={$placementId}&exchangeId={$exchangeId}"><img
					src="/images/drillup.png"
					title="{$drillUpTime}"
				/></a>
			</td>
			<td>bidRequests</td>
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
		{foreach from=$rows key=key item=row}
			<tr class="bidderUIRow">
				<td align="right">
					<a href="/reports?entity={$entity}&timeUnit=minute&time={$row.date}-{$row.hour}:{$row.minute}&campaignId={$campaignId}&placementId={$placementId}&exchangeId={$exchangeId}">{$row.minute}</a>
				</td>
				<td align="right">{$row.bidRequests|numberFormat:0}</td>
				<td align="right">{$row.bids|numberFormat:0}</td>
				<td align="right">{$row.wins|numberFormat:0}</td>
				<td align="right">{$row.winRate|numberFormat:0:'%'}</td>
				<td align="right">{$row.cost|numberFormat:2:'$'}</td>
				<td align="right">{$row.cpm|numberFormat:2:'$'}</td>
				<td align="right">{$row.views|numberFormat:0}</td>
				<td align="right">{$row.viewRate|numberFormat:0:'%'}</td>
				<td align="right">{$row.cpv|numberFormat:2:'$'}</td>
				<td align="right">{$row.clicks|numberFormat:0}</td>
				<td align="right">{$row.clickRate|numberFormat:0:'%'}</td>
				<td align="right">{$row.cpc|numberFormat:2:'$'}</td>
				<td align="right">{$row.revenue|numberFormat:2:'$'}</td>
				<td align="right">{$row.rpm|numberFormat:2:'$'}</td>
				<td align="right">{$row.profit|numberFormat:2:'$'}</td>
				<td align="right">{$row.ppm|numberFormat:2:'$'}</td>
			</tr>
		{/foreach}
	</table>
</div>
