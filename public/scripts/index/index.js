$("document").ready(function(){
	$("#btn-create").click(function(){
		$(".dlg-task").data("id","").dialog("open");
	});

	$("#btn-search").click(function(){
		let taskName = $("#txt-search-taskname").val();
		let taskDesc = $("#txt-search-taskdesc").val();
		let duedate = $("#txt-search-duedate").val();
		let taskObj = $T(taskName, taskDesc, duedate);
		let response = taskObj.searchTask();
		let task = "";

		let table = `<table>
						<thead>
							<tr>
								<th>Task Name</th>
								<th>Task Description</th>
								<th>Duedate</th>
								<th>Created At</th>
								<th>Updated At</th>
								<th>Actions</th>
							<tr>
						</thead>`;
		response = JSON.parse(response);
		let data = response.data;
		let page = response.page;
		console.log(page);
		for (let key in data) {
		    if (data.hasOwnProperty(key)) {
		        task = data[key];

		        table += `	<tbody>
			        			<tr>
			        				<td>${task.task_name}<td>
			        				<td>${task.task_desc}<td>
			        				<td>${task.duedate}<td>
			        				<td>${task.added_at}<td>
			        				<td>${task.updated_at}<td>
			        				<td>
			        					<button class='btn btn-edit' data-task='${JSON.stringify(task)}' type='button'>Edit</button>
			        					<button class='btn btn-delete' data-id='${task.id}' type='button'>Delete</button>
			        				<td>
			        			</tr>
			        		</tbody>`;
		    }
		}
		table += `</body>`;
		$("#div-tasklist").html(table);
		$(".btn").button();
	});
	$("#div-tasklist").on("click",".btn-edit",function(){
		let task = $(this).attr("data-task");
		task = JSON.parse(task);
		$("#txt-taskname").val(task.task_name);
		$("#txt-taskdesc").val(task.task_desc);
		$("#txt-duedate").val(task.duedate);
		$(".dlg-task").data("id",task.id).dialog("open");
	});
	$("#div-tasklist").on("click",".btn-delete",function(){
		
		let taskid = $(this).attr("data-id");
		let task = $T(taskid);
		task.action = "deleteTask";
		task.confirmAction();		
		$("#lbl-confirmmsg").text("Do you want to delete this task?");
	});
	$("#btn-search").trigger("click");
});