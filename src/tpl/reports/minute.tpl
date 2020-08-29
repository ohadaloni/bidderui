	<table border="0">
		<tr class="bidderUIHeaderRow">
			<td>
				#
				<a href="/reports?entity={$entity}&timeUnit=hour&time={$drillUpTime}&campaignId={$campaignId}&placementId={$placementId}&exchangeId={$exchangeId}"><img
					src="/images/drillup.png"
					title="{$drillUpTime}"
				/></a>
			</td>
			<td>datetime</td>
			<td>campaign</td>
			<td>cost</td>
			<td>revenue</td>
			<td width="10" style="background-color:#eee"></td>
			<td>exchange</td>
			<td>placementId</td>
			<td>bidRequestId</td>
			<td>bidId</td>
		</tr>
		{foreach from=$rows key=key item=row}
			{assign var=No value=`$key+1`}
			<tr class="bidderUIRow">
				<td align="right">{$No}</td>
				<td align="right">{$row.datetime}</td>
				<td align="right">{$row.campaignId|campaignName}</td>
				<td align="right">{$row.cost|numberFormat:4:'$'}</td>
				<td align="right">{$row.revenue|numberFormat:4:'$'}</td>
				<td width="10" style="background-color:#eee"></td>
				<td align="right">{$row.exchangeId|exchangeName}</td>
				<td align="right">{$row.placementId}</td>
				<td align="right">{$row.bidRequestId}</td>
				<td align="right">{$row.bidId}</td>
			</tr>
		{/foreach}
	</table>
