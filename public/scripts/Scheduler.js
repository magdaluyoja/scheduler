;(function(global, $){
	const Task = function(id, taskName, taskDesc, dueDate){
		return new Task.init(id, taskName, taskDesc, dueDate);
	}

	Task.init = function(id, taskName, taskDesc, dueDate){
		this.taskId = id || "";
		this.taskName = taskName || "";
		this.taskDesc = taskDesc || "";
		this.dueDate = dueDate || "";
		this.action = "";
	}

	Task.prototype = {
		validate:function(){
			let errmsg = "";
			if(!this.taskName.replace(/\s/g, '').length){
				errmsg += "Task Name must not be empty.<br>";
			}
			if(!this.taskDesc.replace(/\s/g, '').length){
				errmsg += "Task Description must not be empty.<br>";
			}
			if(!this.dueDate.replace(/\s/g, '').length){
				errmsg += "Task Duedate must not be empty.";
			}
			if (errmsg) {
				$(".divmsg").html(errmsg);
				$(".divmsg").addClass("error");
			}else{
				$(".divmsg").html("");
				$(".divmsg").removeClass("error");
				this.action = "saveTask";
				let response = this.submitTaskData(this);
				if(response === "success"){
					if(this.taskId){
						$(".divmsg").html("Task was successfully updated.");
					}else{
						$(".divmsg").html("Task was successfully saved.");
					}
					$(".divmsg").addClass("success");
					this.resetTask().resetForm();
					$("#btn-search").trigger("click");

				}else{
					$(".divmsg").html(response);
					$(".divmsg").addClass("error");
				}
			}
		},
		submitTaskData:function(data, page){
			page = page || [];
			let output = "";
			let task_data = JSON.stringify(data);
			page = JSON.stringify(page);
			$.ajax({
				type:"POST",
				data:{Task:task_data, Page:page},
				url: "../includes/classes/Task.php",
				beforeSend:function(){

				},
				success:function(response){
					output = response;
				},
				async: false
			});
			if(output){
				return output;
			}
		},
		searchTask:function(){
			this.action = "searchTask";
			return this.submitTaskData(this,{limit:1, pageno:1});
			
		},
		confirmAction:function(){
			let self = this;
			let conAction = this.action;
			$(".dlg-confirm").dialog({
				title:"Confirm",
				modal:true,
				autoOpen: true,
				width: "auto",
				buttons: [
					{
						text: "No",
						click: function() {
							$( this ).dialog( "close" );
						}
					},
					{
						text: "Yes",
						click: function() {
							self[conAction]();
						}
					}
				]
			});	
		},
		deleteTask:function(){
			let response = this.submitTaskData({taskId: this.taskId, action: this.action});
			if(response === "success"){
				iziToast.success({timeout: 5000, icon: 'fa fa-check-circle', title: 'OK', message: 'Task was successfully deleted!'});
			}else{
				iziToast.error({title: 'Error', message: response});
			}
		},
		resetTask:function(){
			this.taskId = "";
			this.taskName = "";
			this.taskDesc = "";
			this.dueDate = "";
			this.action = "";
			return this;
		},
		resetForm:function(){
			$("#txt-taskname").val("");
			$("#txt-taskdesc").val("");
			$("#txt-duedate").val("");
			return this;
		},
		resetMsg:function(){
			$(".divmsg").html("");
			$(".divmsg").removeClass("error");
			$(".divmsg").removeClass("success");
			return this;
		}
	}

	Task.init.prototype = Task.prototype;

	return global.Task = global.$T = Task;
}(window,$));