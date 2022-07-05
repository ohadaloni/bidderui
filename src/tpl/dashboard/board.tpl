<div class="container">	 
	<table border="0">
		<tr class="bidderUIHeaderRow">
			<td>{$datetime}</td>
			{foreach from=$timeSlots item=timeSlot}
				<td>
					{if $timeSlot == 'thisMinute'}
						thisMinute
					{else}
						<a
							{if $campaignId}
								href="/reports?entity=campaign&timeUnit={$timeSlot|timeUnit}&time=now&campaignId={$campaignId}"
							{elseif $exchangeId}
								href="/reports?entity=exchange&timeUnit={$timeSlot|timeUnit}&time=now&exchangeId={$exchangeId}"
							{else}
								href="/reports?entity=bidder&timeUnit={$timeSlot|timeUnit}&time=now"
							{/if}
							title="report"
						>{$timeSlot}</a>
					{/if}
				</td>
			{/foreach}
		</tr>
		<tr class="bidderUIRow">
			<td style="background-color: #aaa;" colspan="7" height="10px"></td>
		</tr>
		{if ! $campaign}
			<tr class="bidderUIRow">
				<td>bidRequests</td>
				{foreach from=$board.bidRequests item=timeSlotValue}
					<td align="right">{$timeSlotValue|numberFormat:0}</td>
				{/foreach}
			</tr>
		{/if}
		<tr class="bidderUIRow">
			<td>bids</td>
			{foreach from=$board.bids item=timeSlotValue}
				<td align="right">{$timeSlotValue|numberFormat:0}</td>
			{/foreach}
		</tr>
		{if ! $campaign}
			<tr class="bidderUIRow">
				<td>bidRate</td>
				{foreach from=$board.bidRate item=timeSlotValue}
					<td align="right">{$timeSlotValue|numberFormat:0:'%'}</td>
				{/foreach}
			</tr>
		{/if}
		<tr class="bidderUIRow">
			<td style="background-color: #aaa;" colspan="7" height="10px"></td>
		</tr>
		<tr class="bidderUIRow">
			<td>wins</td>
			{foreach from=$board.wins item=timeSlotValue}
				<td align="right">{$timeSlotValue|numberFormat:0}</td>
			{/foreach}
		</tr>
		<tr class="bidderUIRow">
			<td>winRate</td>
			{foreach from=$board.winRate item=timeSlotValue}
				<td align="right">{$timeSlotValue|numberFormat:0:'%'}</td>
			{/foreach}
		</tr>
		<tr class="bidderUIRow">
			<td style="background-color: #aaa;" colspan="7" height="10px"></td>
		</tr>
		<tr class="bidderUIRow">
			<td>cost</td>
			{foreach from=$board.cost item=timeSlotValue}
				<td align="right">{$timeSlotValue|numberFormat:2:'$'}</td>
			{/foreach}
		</tr>
		<tr class="bidderUIRow">
			<td>cpm</td>
			{foreach from=$board.cpm item=timeSlotValue}
				<td align="right">{$timeSlotValue|numberFormat:2:'$'}</td>
			{/foreach}
		</tr>
		<tr class="bidderUIRow">
			<td style="background-color: #aaa;" colspan="7" height="10px"></td>
		</tr>
		<tr class="bidderUIRow">
			<td>views</td>
			{foreach from=$board.views item=timeSlotValue}
				<td align="right">{$timeSlotValue|numberFormat:0}</td>
			{/foreach}
		</tr>
		<tr class="bidderUIRow">
			<td>viewRate</td>
			{foreach from=$board.viewRate item=timeSlotValue}
				<td align="right">{$timeSlotValue|numberFormat:0:'%'}</td>
			{/foreach}
		</tr>
		<tr class="bidderUIRow">
			<td>cpv</td>
			{foreach from=$board.cpv item=timeSlotValue}
				<td align="right">{$timeSlotValue|numberFormat:2:'$'}</td>
			{/foreach}
		</tr>
		<tr class="bidderUIRow">
			<td style="background-color: #aaa;" colspan="7" height="10px"></td>
		</tr>
		<tr class="bidderUIRow">
			<td>clicks</td>
			{foreach from=$board.clicks item=timeSlotValue}
				<td align="right">{$timeSlotValue|numberFormat:0}</td>
			{/foreach}
		</tr>
		<tr class="bidderUIRow">
			<td>clickRate</td>
			{foreach from=$board.clickRate item=timeSlotValue}
				<td align="right">{$timeSlotValue|numberFormat:0:'%'}</td>
			{/foreach}
		</tr>
		<tr class="bidderUIRow">
			<td>cpc</td>
			{foreach from=$board.cpc item=timeSlotValue}
				<td align="right">{$timeSlotValue|numberFormat:2:'$'}</td>
			{/foreach}
		</tr>
		<tr class="bidderUIRow">
			<td style="background-color: #aaa;" colspan="7" height="10px"></td>
		</tr>
		<tr class="bidderUIRow">
			<td>revenue</td>
			{foreach from=$board.revenue item=timeSlotValue}
				<td align="right">{$timeSlotValue|numberFormat:2:'$'}</td>
			{/foreach}
		</tr>
		<tr class="bidderUIRow">
			<td>rpm</td>
			{foreach from=$board.rpm item=timeSlotValue}
				<td align="right">{$timeSlotValue|numberFormat:2:'$'}</td>
			{/foreach}
		</tr>
		<tr class="bidderUIRow">
			<td style="background-color: #aaa;" colspan="7" height="10px"></td>
		</tr>
		<tr class="bidderUIRow">
			<td>profit</td>
			{foreach from=$board.profit item=timeSlotValue}
				<td align="right">{$timeSlotValue|numberFormat:2:'$'}</td>
			{/foreach}
		</tr>
		<tr class="bidderUIRow">
			<td>ppm</td>
			{foreach from=$board.ppm item=timeSlotValue}
				<td align="right">{$timeSlotValue|numberFormat:2:'$'}</td>
			{/foreach}
		</tr>
	</table>
</div>
