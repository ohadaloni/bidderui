<div class="container">	 
	<table>
		<tr class="bidderUIHeaderRow">
			<td width="50">
				BlackLists:
			</td>
			{foreach from=$blackLists item=blackList}
				<td width="50"></td>
				<td>
					{$blackList.name}:
				</td>
				<td>
					{if $blackList.on}
						<form method="get" action="/blackLists/blackListOff">
							<input type="checkbox" name="ok" />
							<input type="hidden" name="blackListId" value="{$blackList.id}" />
							<input type="hidden" name="campaignId" value="{$campaignId}" />
							<input
								type="image"
								src="/images/circles/green.png"
								title="in effect - check the box and click button to turn off"
							/>
						</form>
					{else}
						<form method="get" action="/blackLists/blackListOn">
							<input type="checkbox" name="ok" />
							<input type="hidden" name="blackListId" value="{$blackList.id}" />
							<input type="hidden" name="campaignId" value="{$campaignId}" />
							<input
								type="image"
								src="/images/circles/red.png"
								title="not in effect - check the box and click button to turn on"
							/>
						</form>
					{/if}
				</td>
			{/foreach}
		</tr>
	</table>
</div>
