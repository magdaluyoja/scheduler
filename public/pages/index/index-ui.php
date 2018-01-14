<div class="dlg-task">
	<div class="divmsg"></div>
	<form id="frmsearchtask">
		<table>
			<tr>
				<td>Task Name:</td>
				<td><input type="text" name="txt-taskname" id="txt-taskname"></td>
			</tr>
			<tr>
				<td>Task Description:</td>
				<td><input type="text" name="txt-taskdesc" id="txt-taskdesc"></td>
			</tr>
			<tr>
				<td>Task Duedate:</td>
				<td><input type="text" name="txt-duedate" id="txt-duedate" class="datetime"></td>
			</tr>
		</table>
	</form>
</div>
<div class="dlg-confirm">
	<p id="lbl-confirmmsg"></p>
</div>
<script >
	$("#txt-duedate").datetimepicker();
	$("#txt-search-duedate").datetimepicker({timepicker:false,format:'d/m/Y'});
	$(".btn").button();
	$(".dlg-task").dialog({
		title:"Task",
		modal:true,
		autoOpen: false,
		width: "auto",
		buttons: [
			{
				text: "Close",
				click: function() {
					$T().resetTask().resetForm().resetMsg();
					$( this ).dialog( "close" );
				}
			},
			{
				text: "Submit",
				click: function() {
					let taskId = $(this).data('id');
					let taskName = $("#txt-taskname").val();
					let taskDesc = $("#txt-taskdesc").val();
					let duedate = $("#txt-duedate").val();
					console.log(taskId);
					let task = $T(taskId, taskName, taskDesc, duedate);
					task.validate();
				}
			}
		]
	});	
	
</script>