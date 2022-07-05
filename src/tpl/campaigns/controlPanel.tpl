<div class="container">
	<a href="/campaigns" title="campaigns"><img src="/images/arrowUp.png" />Campaigns</a>
	<br />
	<h2>{$campaign.name}</h2>
	{if $campaign.banner}
		<img
			src="{$bannerUrl}/{$campaign.banner}"
			height="50"
		/>
	{/if}
	<br />
	<br />
	<table>
		<tr class="bidderUIHeaderRow">
			<td>
				On/Off:
			</td>
			<td>
				{if $campaign.onSwitch}
					<form method="get" action="/campaigns/off">
						<input type="checkbox" name="ok" />
						<input type="hidden" name="campaignId" value="{$campaign.id}" />
						<input type="hidden" name="dash" value="dash" />
						<input
							type="image"
							src="/images/circles/green.png"
							title="Campaign is On - check the box and click button to turn off"
						/>
					</form>
				{else}
					<form method="get" action="/campaigns/on">
						<input type="checkbox" name="ok" />
						<input type="hidden" name="dash" value="dash" />
						<input type="hidden" name="campaignId" value="{$campaign.id}" />
						<input
							type="image"
							src="/images/circles/red.png"
							title="Campaign is Off - check the box and click button to turn on"
						/>
					</form>
				{/if}
			</td>
		</tr>
	</table>
	<form method="post" action="/campaigns/changeCampaign">
		<table>
			<tr class="bidderUIHeaderRow">
				<td>baseBid</td>
				<td>
					<input type="text" name="baseBid" size="6" value="{$campaign.baseBid}" />
				</td>
				<td>maxBid</td>
				<td>
					<input type="text" name="maxBid" size="6" value="{$campaign.maxBid}" />
				</td>
				<td>dailyBudget</td>
				<td>
					<input type="text" name="dailyBudget" size="6" value="{$campaign.dailyBudget}" />
				</td>
				<td>
					<input type="checkbox" name="ok" />
					<input type="hidden" name="campaignId" value="{$campaign.id}" />
					<input type="hidden" name="dash" value="dash" />
					<input type="submit" value="change {$campaign.name}" />
				</td>
			</tr>
		</table>
	</form>
</div>
