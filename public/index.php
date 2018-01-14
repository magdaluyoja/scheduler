<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="stylesheets/main.css">
		<link rel="stylesheet" type="text/css" href="vendor/cupertino/jquery-ui.min.css">
		<link rel="stylesheet" type="text/css" href="vendor/datetimepicker/jquery.datetimepicker.css">
		<link rel="stylesheet" type="text/css" href="vendor/iziToast/dist/css/iziToast.min.css">
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		
		<?php require_once 'pages/layouts/_header.php'; ?>
	
		<?php require_once 'pages/layouts/_topnav.php'; ?>

		<div id="div-container">
	  		<?php require_once 'pages/layouts/_leftsidebar.php'; ?>

		  	<div id="div-content">
			    <div>
			    	<form id="frmsearchtask">
			    		<table>
			    			<tr>
			    				<td>Task Name:</td>
			    				<td><input type="text" name="txt-search-taskname" id="txt-search-taskname"></td>
			    			</tr>
			    			<tr>
			    				<td>Task Description:</td>
			    				<td><input type="text" name="txt-search-taskdesc" id="txt-search-taskdesc"></td>
			    			</tr>
			    			<tr>
			    				<td>Task Duedate:</td>
			    				<td><input type="text" name="txt-search-duedate" id="txt-search-duedate"></td>
			    			</tr>
			    			<tr>
			    				<td></td>
			    				<td>
			    					<button type="button" id="btn-search" class="btn">Search</button>
			    					<button type="button" id="btn-create" class="btn">Create</button>
			    				</td>
			    			</tr>
			    		</table>
			    	</form>
			    	<div id="div-tasklist"></div>
			    </div>
		  	</div>

	  		<?php require_once 'pages/layouts/_rightsidebar.php'; ?>
		</div>
		
		<?php require_once 'pages/layouts/_footer.php'; ?>
		<script src="vendor/jquery-3.2.1.js"></script>
		<script src="vendor/datetimepicker/build/jquery.datetimepicker.full.min.js"></script>
		<script src="vendor/cupertino/jquery-ui.min.js"></script>
		<script src="vendor/iziToast/dist/js/iziToast.min.js"></script>
		<?php require_once 'pages/index/index-ui.php'; ?>
		<script src="scripts/Scheduler.js"></script>
		<script src="scripts/index/index.js"></script>
	</body>
</html>
