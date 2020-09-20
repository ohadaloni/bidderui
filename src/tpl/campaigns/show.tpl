<div class="container">	 
	<table>
		<tr class="bidderUIHeaderRow">
			<td>name</td>
			<td>owner</td>
			<td>kind</td>
			<td>onSwitch</td>
			<td>dailyBudget</td>
			<td>baseBid</td>
			<td>maxBid</td>
			<td><a title="Desired Profit Margin">Pmrgn</a></td>
			<td>geo</td>
			<td>banner</td>
			<td>landingPage</td>
			<td>days</td>
			<td>hours</td>
			<td>w</td>
			<td>h</td>
			<td>changed</td>
			<td>by</td>
			<td colspan="4">
				<a href="/campaigns/newCampaign"><img
					src="/images/new.png"
					title="New Campaign"
				/></a>
			</td>
		<tr>
		{foreach from=$rows item=row}
			<tr class="bidderUIRow">
				<td>{$row.name}</td>
				<td>{$row.owner}</td>
				<td>{$row.kind}</td>
				<td>
					{if $row.onSwitch}
						<form method="get" action="/campaigns/off">
							<input type="checkbox" name="ok" />
							<input type="hidden" name="campaignId" value="{$row.id}" />
							<input
								type="image"
								src="/images/circles/green.png"
								title="check the box and click button to confirm turning off"
							/>
						</form>
					{else}
						<form method="get" action="/campaigns/on">
							<input type="checkbox" name="ok" />
							<input type="hidden" name="campaignId" value="{$row.id}" />
							<input
								type="image"
								src="/images/circles/red.png"
								title="check the box and click button to confirm turning on"
							/>
						</form>
					{/if}
				</td>
				<td align="right">{$row.dailyBudget}</td>
				<td align="right">{$row.baseBid}</td>
				<td align="right">{$row.maxBid}</td>
				<td align="right">{$row.desiredProfitMargin|numberFormat:0:'%'}</td>
				<td><img src="/images/flags/{$row.geo|strtolower}.png" />{$row.geo}</td>
				<td>
					{if $row.banner}
						<a target="banner" href="{$bannerUrl}/{$row.banner}"><img
							src="{$bannerUrl}/{$row.banner}"
							height="50"
						/></a>
					{/if}
				</td>
				<td>
					<a
						target="_blank"
						href="{$row.landingPage}"
						title="{$row.landingPage}"
						>{$row.landingPage|truncate:10}</a>
				</td>
				<td>{$row.weekDays|weekDaysStr}</td>
				<td>{$row.hours}</td>
				<td align="right">{$row.w}</td>
				<td align="right">{$row.h}</td>
				<td>{$row.lastUpdated}</td>
				<td>{$row.lastUpdatedBy}</td>

				<td><a href="/campaigns/edit?campaignId={$row.id}"><img
					border="0"
					src="/images/edit.png"
					title="edit"
				/></a></td>
				<td>
					<a href="/campaigns/dup?campaignId={$row.id}"><img
						border="0"
						title="duplicate"
						src="/images/duplicate.png"
					/></a>
				</td>
				<td>
					<a href="/dashboard?campaignId={$row.id}"><img
						border="0"
						title="Dashboard"
						src="/images/table.png"
					/></a>
				</td>
				<td>
					{if $row.isDeletable}
						<form method="get" action="/campaigns/remove">
							<input type="checkbox" name="ok" />
							<input type="hidden" name="campaignId" value="{$row.id}" />
							<input
								type="image"
								src="/images/delete.png"
								title="delete campaign {$row.name}"
							/>
					{else}
						<img
							src="/images/fade/delete.png"
							title="don't want to delete campaigns with history"
						/>
					{/if}
				</td>
			</tr>
		{/foreach}
	</table>
</div>
