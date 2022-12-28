<?php
/* Previent Direct Access */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<div class="container-xl">
	<div class="row row-deck row-cards">
		<div class="mb-3">
			<div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">

				<!-- Display Task List -->
				<div class="assigned-task-list"></div>
				<!-- END -->

			</div>
		</div>
	</div>
</div>

<?php
get_footer();
?>
<script>
	var root ="../../";
	assignedTaskList = document.querySelector(".assigned-task-list");

	$(document).ready(function() {
		getAssignedTaskList();
	});

	//Get Task List
	function getAssignedTaskList(){
		let xhr = new XMLHttpRequest();
		xhr.open("POST", root + "/ajax/get-assigned-tasks.php", true);
		xhr.onload = ()=>{
			if(xhr.readyState === XMLHttpRequest.DONE){
				if(xhr.status === 200){
					let data = xhr.response;
					assignedTaskList.innerHTML = data;
				}
			}
		}
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send();
	}

	/**
 * 
 * Auto Server Request
 * 
 */
	setInterval(getAssignedTaskList, 10000);

</script>