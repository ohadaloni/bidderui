<div class="container">	 
	<a href="/campaigns" title="campaigns"><img src="/images/arrowUp.png" />Campaigns</a>
	<br />
	<br />
	<h3> {$campaign.name}</h3>
	{if $campaign.banner}
		<img src="{$bannerUrl}/{$campaign.banner}" />
	{/if}
	<br />
	<br />
	<form action="/campaigns/newBanner" method="post" enctype="multipart/form-data">
		<table>
			<tr class="bidderUIHeaderRow">
				<td>New Banner</td>
				<td>
					<input type="file" name="files[]" multiple />
				</td>
				<td>
					<input type="hidden" name="campaignId" value="{$campaign.id}" />
					<input type="submit" value="New Banner" />
				</td>
			</tr>
		<table>

	</form>
	<br />
	<br />

	<form method="post" action="/campaigns/changeCampaign">
		<table>
			<tr class="bidderUIRow">
				<td>name</td>
				<td>
					<input type="text" name="name" value="{$campaign.name}" size="80" />
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>kind</td>
				<td>
					{msuShowTpl file="selectString.tpl"  name="kind" from=$kinds selected=$campaign.kind}
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>dailyBudget</td>
				<td>
					<input type="text" name="dailyBudget" size="6" value="{$campaign.dailyBudget}" />
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>baseBid</td>
				<td>
					<input type="text" name="baseBid" size="6" value="{$campaign.baseBid}" />
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>maxBid</td>
				<td>
					<input type="text" name="maxBid" size="6" value="{$campaign.maxBid}" />
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td><a title="Desired Profit Margin">Pmrgn</a></td>
				<td>
					<input type="text" name="desiredProfitMargin" size="6" value="{$campaign.desiredProfitMargin}" />%
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>geo</td>
				<td>
					{msuShowTpl file="select.tpl" name="geo" from=$countries fname="name" idname="code" selected=$campaign.geo}
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>banner</td>
				<td>
					{$campaign.banner}
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>(or) Ad Markup</td>
				<td>
					<textarea name="adm" rows="20" cols="80">{$campaign.adm}</textarea>
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>landingPage</td>
				<td>
					<input type="text" name="landingPage" size="120" value="{$campaign.landingPage}" />
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>week days</td>
				<td>
					{foreach from=$weekDays item=weekDay}
						{$weekDay|weekDayStr}<input type="checkbox" name="weekDays[]" value="{$weekDay}" 
							{if $campaignWeekDays && $weekDay|in_array:$campaignWeekDays}checked="checked"{/if} />
					{/foreach}
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>hours</td>
				<td>
					{foreach from=$dayHours item=hour}
						{$hour}<input type="checkbox" name="hours[]" value="{$hour}" 
							{if $campaignHours && $hour|in_array:$campaignHours}checked="checked"{/if} />
						{if $hour == 11}
							<br />
						{/if}
					{/foreach}
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td></td>
				<td>
					<input type="hidden" name="ok" value="on" />
					<input type="hidden" name="campaignId" value="{$campaign.id}" />
					<input type="submit" value="change {$campaign.name}" />
				</td>
			</tr>
		</table>
	</form>
</div>
