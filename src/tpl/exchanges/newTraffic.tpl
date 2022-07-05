<div class="container">
	<form method="get" action="/exchanges/insertTraffic">
		<table>
			<tr class="bidderUIHeaderRow">
				<td colspan="2">Edit Traffic simulation row</td>
			</tr>
			<tr class="bidderUIRow">
				<td>strength</td>
				<td>
					<input type="text" name="strength" />
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>kind</td>
				<td>
					{msuShowTpl file="selectString.tpl" name="kind" from=$kinds}
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>w</td>
				<td>
					<input type="text" name="w" />
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>h</td>
				<td>
					<input type="text" name="h" />
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>geo</td>
				<td>
					{msuShowTpl file="select.tpl" name="geo" from=$countries fname="name" idname="code3"}
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>gender</td>
				<td>
					{msuShowTpl file="selectString.tpl" name="gender" from=$genders}
				</td>
			</tr>
			<tr class="bidderUIRow">
				<td>ageGroup</td>
				<td>
					{msuShowTpl file="selectString.tpl" name="ageGroup" from=$ageGroups}
				</td>
			</tr>
			<tr class="bidderUIHeaderRow">
				<td colspan="2" align="right">
					<input type="submit" value="New Traffic Row" />
				</td>
			</tr>
		</table>
	</form>
</div>
