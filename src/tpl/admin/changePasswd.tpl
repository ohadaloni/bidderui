<form method="get" action="/bidderUI/updatePasswd">
	<table border="0">
		<tr class="bidderUIHeaderRow">
			<td colspan="2">Changeing Password for {$loginName}</td>
		</tr>
		<tr class="bidderUIRow">
			<td>Old Password</td>
			<td><input type="text" name="oldPasswd" size="30" /></td>
		</tr>
		<tr class="bidderUIRow">
			<td>New Password</td>
			<td><input type="text" name="newPasswd" size="30" /></td>
		</tr>
		<tr class="bidderUIRow">
			<td>New Password (again)</td>
			<td><input type="text" name="newPasswd2" size="30" /></td>
		</tr>
		<tr class="bidderUIRow">
			<td></td>
			<td><input type="submit" value="Update Password" /></td>
		</tr>
	</table>
</form>
