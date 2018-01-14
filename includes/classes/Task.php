<?php 
	require_once "../config.php";
	require_once "Pagination.php";
	/**
	* 
	*/
	class  Task
	{
		public $taskId = "";
		public $taskName = "";
		public $taskDesc = "";
		public $dueDate = "";
		public $page = "";
		function __construct($taskId = "", $taskName = "", $taskDesc = "", $dueDate = "", $page="")
		{
			$this->taskId = $taskId;
			$this->taskName = $taskName;
			$this->taskDesc = $taskDesc;
			$this->dueDate = $dueDate;
			$this->page = $page;
		}

		public function saveTask(){
			global $conn;
			if($this->taskId){
				$sql = "UPDATE ".DB.".tasks SET `task_name` = '{$this->taskName}', `task_desc` = '{$this->taskDesc}', `duedate` = '{$this->dueDate}', `updated_at` = NOW()
						WHERE id = '{$this->taskId}' LIMIT 1";
			}else{
				$sql = "INSERT INTO ".DB.".tasks(`task_name`, `task_desc`, `duedate`,`added_at`)
						VALUES ('{$this->taskName}', '{$this->taskDesc}', '{$this->dueDate}', NOW())";
			}
			$rssql = $conn->Execute($sql);
			if(!$rssql){
				die($conn->ErrorMsg()."::".__LINE__);
			}else{
				echo "success";
			}
		}
		public function searchTask(){
			global $conn;


			$where = " 1 ";
			if ($this->taskName) {
				$where .= " AND task_name LIKE '%{$this->taskName}%'";
			}
			if ($this->taskDesc) {
				$where .= " AND task_name LIKE '%{$this->taskDesc}%'";
			}
			if ($this->dueDate) {
				$where .= " AND duedate = '$this->dueDate'";
			}

			$sql = "SELECT * FROM ".DB.".tasks WHERE $where";
			$total_items = $this->getTotalItems($sql);
			$limit = $this->page->limit;
			$pageno = $this->page->pageno;
			$offset = ($pageno - 1) * $limit;
			$offset = $pageno === 1 ? "" : ", $offset";
			$total_page = ceil($total_items/$limit);

			$sql = "SELECT * FROM ".DB.".tasks WHERE $where LIMIT $limit $offset";


			$rssql = $conn->Execute($sql);
			if(!$rssql){
				die($conn->ErrorMsg()."::".__LINE__);
			}else{
				$total_items = $rssql->RecordCount();
				while (!$rssql->EOF){
				    $obj = $rssql->fetchNextObj();
				    $arrTask[] = $obj;
				}
			}
			$arrTask = isset($arrTask) ? $arrTask : [];
			echo json_encode(["data"=>$arrTask, "page"=>["pageno"=>$pageno, "total_page"=>$total_page]]);
		}
		public function getTotalItems($sql){
			global $conn;
			$rssql = $conn->Execute($sql);
			if(!$rssql){
				die($conn->ErrorMsg()."::".__LINE__);
			}else{
				return $total_items = $rssql->RecordCount();
			}
		}
		public function deleteTask(){
			global $conn;
			$sql = "DELETE FROM ".DB.".tasks WHERE id = '{$this->taskId}' LIMIT 1";
			$rssql = $conn->Execute($sql);
			if(!$rssql){
				die($conn->ErrorMsg()."::".__LINE__);
			}else{
				echo "success";
			}
		}
	}

	$taskObj = isset($_POST["Task"]) ? $_POST["Task"] : [];
	$pageObj = isset($_POST["Page"]) ? $_POST["Page"] : [];
	$task = json_decode($taskObj);
	$page = json_decode($pageObj);

	$action = $task->action;
	$taskId = isset($task->taskId) ? $task->taskId : "";
	$taskName = isset($task->taskName) ? $task->taskName : "";
	$taskDesc = isset($task->taskDesc) ? $task->taskDesc : "";
	$dueDate = isset($task->dueDate) ? $task->dueDate : "";

	$newTask = new Task($taskId, $taskName, $taskDesc, $dueDate, $page);
	$newTask->$action();