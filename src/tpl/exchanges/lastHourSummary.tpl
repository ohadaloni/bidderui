<div class="container">	 
	<table border="0">
		<tr class="bidderUIHeaderRow">
			<td>{$hour}</td>
			<td>bidRequests</td>
			<td width="10" style="background-color: #ddd"></td>
			<td>bids</td>
			<td>bidRate</td>
			<td width="10" style="background-color: #ddd"></td>
			<td>wins</td>
			<td>winRate</td>
			<td width="10" style="background-color: #ddd"></td>
			<td>cost</td>
			<td>cpm</td>
			<td width="10" style="background-color: #ddd"></td>
			<td>views</td>
			<td>viewRate</td>
			<td>cpv</td>
			<td width="10" style="background-color: #ddd"></td>
			<td>clicks</td>
			<td>clickRate</td>
			<td>cpc</td>
			<td width="10" style="background-color: #ddd"></td>
			<td>revenue</td>
			<td>rpm</td>
			<td width="10" style="background-color: #ddd"></td>
			<td>profit</td>
			<td>ppm</td>
		</tr>
		{foreach from=$exchanges item=exchange}
			<tr class="bidderUIRow">
				<td>
					<a href="/reports?entity=exchange&timeUnit=allTime&&exchangeId={$exchange.id}">{$exchange.name}</a>
				</td>
				<td align="right">{$exchange.bidRequests|numberFormat:0}</td>
				<td width="10" style="background-color: #ddd"></td>
				<td align="right">{$exchange.bids|numberFormat:0}</td>
				<td align="right">{$exchange.bidRate|numberFormat:2:'%'}</td>
				<td width="10" style="background-color: #ddd"></td>
				<td align="right">{$exchange.wins|numberFormat:0}</td>
				<td align="right">{$exchange.winRate|numberFormat:2:'%'}</td>
				<td width="10" style="background-color: #ddd"></td>
				<td align="right">{$exchange.cost|numberFormat:2:'$'}</td>
				<td align="right">{$exchange.cpm|numberFormat:2:'$'}</td>
				<td width="10" style="background-color: #ddd"></td>
				<td align="right">{$exchange.views|numberFormat:0}</td>
				<td align="right">{$exchange.viewRate|numberFormat:1:'%'}</td>
				<td align="right">{$exchange.cpv|numberFormat:2:'$'}</td>
				<td width="10" style="background-color: #ddd"></td>
				<td align="right">{$exchange.clicks|numberFormat:0}</td>
				<td align="right">{$exchange.clickRate|numberFormat:3:'%'}</td>
				<td align="right">{$exchange.cpc|numberFormat:3:'$'}</td>
				<td width="10" style="background-color: #ddd"></td>
				<td align="right">{$exchange.revenue|numberFormat:2:'$'}</td>
				<td align="right">{$exchange.rpm|numberFormat:2:'$'}</td>
				<td width="10" style="background-color: #ddd"></td>
				<td align="right">{$exchange.profit|numberFormat:2:'$'}</td>
				<td align="right">{$exchange.ppm|numberFormat:2:'$'}</td>
			</tr>
		{/foreach}
	</table>
</div>
