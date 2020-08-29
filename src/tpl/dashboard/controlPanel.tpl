<div class="container">	 
	<table>
		<tr class="bidderUIHeaderRow">
			<td>
				On/Off:
			</td>
			<td>
				{if $controlPanel.onOff}
					<form method="get" action="/controlPanel/off">
						<input type="checkbox" name="ok" />
						<input
							type="image"
							src="/images/circles/green.png"
							title="Bidder is On - check the box and click button to turn off"
						/>
					</form>
				{else}
					<form method="get" action="/controlPanel/on">
						<input type="checkbox" name="ok" />
						<input
							type="image"
							src="/images/circles/red.png"
							title="Bidder is Off - check the box and click button to turn on"
						/>
					</form>
				{/if}
			</td>
			<td width="50px">
			</td>
			<td>
				Daily Budget:
			</td>
			<td>
				<form method="get" action="/controlPanel/setDailyBudget">

					<input type="text" name="dailyBudget" size="12" value="{$controlPanel.dailyBudget}" />
					<input type="checkbox" name="ok" />
					<input type="submit" value="Change" />
				</form>

			</td>
		</tr>
	</table>
</div>
