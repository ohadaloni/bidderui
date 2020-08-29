<div class="container">	 
	<a href="/campaigns" title="campaigns"><img src="/images/arrowUp.png" />Campaigns</a>
	<br />
	<br />
	<form method="post" action="/campaigns/insertCampaign">
		<table>
			<tr class="bidderUIRow">
				<td>name</td>
				<td>
					<input type="text" name="name" size="80" />
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>kind</td>
				<td>
					{msuShowTpl file="selectString.tpl"  name="kind" from=$kinds}
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>dailyBudget</td>
				<td>
					<input type="text" name="dailyBudget" />
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>baseBid</td>
				<td>
					<input type="text" name="baseBid" />
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>maxBid</td>
				<td>
					<input type="text" name="maxBid" />
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td><a title="Desired Profit Margin">Pmrgn</a></td>
				<td>
					<input type="text" name="desiredProfitMargin" size="6" />%
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>geo</td>
				<td>
					{msuShowTpl file="select.tpl"  name="geo" from=$countries fname="name" idname="code"}
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>landingPage</td>
				<td>
					<input type="text" name="landingPage" size="120" />
				</td>
			</tr>
			<tr>
				<td>hours</td>
				<td>
					{foreach from=$dayHours item=hour}
						{$hour}<input type="checkbox" name="hours[]" value="{$hour}" />
						{if $hour == 11}
							<br />
						{/if}
					{/foreach}
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td></td>
				<td>
					<input type="submit" value="New Campaign" />
				</td>
			</tr>
		</table>
	</form>
</div>
