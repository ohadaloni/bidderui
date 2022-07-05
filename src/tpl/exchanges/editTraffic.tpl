<div class="container">
	<form method="get" action="/exchanges/updateTraffic">
		<table>
			<tr class="bidderUIHeaderRow">
				<td colspan="2">Edit Traffic simulation row</td>
			</tr>
			<tr class="bidderUIRow">
				<td>strength</td>
				<td>
					<input type="text" name="strength" value="{$row.strength}" />
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>kind</td>
				<td>
					{msuShowTpl file="selectString.tpl" name="kind" from=$kinds selected=$row.kind}
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>w</td>
				<td>
					<input type="text" name="w" value="{$row.w}" />
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>h</td>
				<td>
					<input type="text" name="h" value="{$row.h}" />
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>geo</td>
				<td>
					{msuShowTpl file="select.tpl" name="geo" from=$countries fname="name" idname="code3" selected=$row.geo}
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>gender</td>
				<td>
					{msuShowTpl file="selectString.tpl" name="gender" from=$genders selected=$row.gender}
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>ageGroup</td>
				<td>
					{msuShowTpl file="selectString.tpl" name="ageGroup" from=$ageGroups selected=$row.ageGroup}
				</td>
			</tr>
			<tr class="bidderUIHeaderRow">
				<td colspan="2" align="right">
					<input type="hidden" name="id" value="{$row.id}" />
					<input type="submit" value="Change Traffic Row" />
				</td>
			</tr>
		</table>
	</form>
</div>
