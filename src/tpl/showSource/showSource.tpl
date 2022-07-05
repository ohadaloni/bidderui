<table border="0">
	<tr>
		<td valign="top">
			<table border="0">
				<tr class="bidderUIHeaderRow">
					<td>Bidder Files</td>
				</tr>
				{foreach from=$bidderFiles item=file}
					<tr class="bidderUIRow">
						<td>
							<a href="/showSource?topDir=bidder&file={$file}">{$file}</a>
						</td>
					</tr>
				{/foreach}
				<tr class="bidderUIHeaderRow">
					<td height="50" style="background-color:555;"></td>
				</tr>
				<tr class="bidderUIHeaderRow">
					<td>Bidder UI & Exchage simulation</td>
				</tr>
				{foreach from=$uiFiles item=file}
					<tr class="bidderUIRow">
						<td>
							<a href="/showSource?topDir=bidderui&file={$file}">{$file}</a>
						</td>
					</tr>
				{/foreach}
			</table>
		</td>
		<td valign="top">
			{if $sourceFile}
				<h4>{$topDir}/{$sourceFile}</h4>
				{$source}
			{/if}
		</td>
	</tr>
</table>
