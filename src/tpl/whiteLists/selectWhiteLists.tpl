<div class="container">	 
	<table>
		<tr class="bidderUIHeaderRow">
			<td width="50">
				WhiteLists:
			</td>
			{foreach from=$whiteLists item=whiteList}
				<td width="50"></td>
				<td>
					{$whiteList.name}:
				</td>
				<td>
					{if $whiteList.on}
						<form method="get" action="/whiteLists/whiteListOff">
							<input type="checkbox" name="ok" />
							<input type="hidden" name="whiteListId" value="{$whiteList.id}" />
							<input type="hidden" name="campaignId" value="{$campaignId}" />
							<input
								type="image"
								src="/images/circles/green.png"
								title="in effect - check the box and click button to turn off"
							/>
						</form>
					{else}
						<form method="get" action="/whiteLists/whiteListOn">
							<input type="checkbox" name="ok" />
							<input type="hidden" name="whiteListId" value="{$whiteList.id}" />
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
