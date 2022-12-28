<?php
/* Previent Direct Access */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( !isset($_REQUEST['category']) OR !can_access() ) {
	header('Location: '.SITE_URL);
	exit;
}

if ( !empty( $_POST['action'] ) AND $_POST['action'] === "update" ) {
    $table = get_table_name('task');

    $task_id = (int) $_POST['update_task_id'];
    $task_title = (string) $_POST['update_task_name'];
    $task_remainder = (string) $_POST['update_remainder_date'];
    $task_due = (string) $_POST['update_due_date'];
    $task_note = (string) $_POST['update_note'];
    $task_priority = (int) $_POST['update_task_priority'];
    $assigned_to = (int) get_user_id ( (string) $_POST['update_assigned_to'] );

    //Update Data Into Task List Table
    $stmt = $db->prepare("UPDATE `{$table}` SET task_title = '{$task_title}', task_remainder = '{$task_remainder}', task_due = '{$task_due}', task_note = '{$task_note}', task_priority = '{$task_priority}', assigned_to = '{$assigned_to}' WHERE task_id = '{$task_id}'");
    $stmt->execute();
}

get_header();
?>

<input type="hidden" name="cat" value="<?php echo secure_str( $_REQUEST['category'] ); ?>" required>

<div class="container-xl">
	<div class="row row-deck row-cards">
		<div class="mb-3">
			<div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">

				<!-- Display Task List -->
				<div class="task-list"></div>
				<!-- END -->

			</div>
		</div>
	</div>
</div>
<!-- OffCanvase -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
	<div class="offcanvas-header">
		<h2 class="offcanvas-title" id="offcanvasEndLabel">Sub Task</h2>
		<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body">

		<div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">

			<form id="add-sub-task">
				<div class="input-group mb-2">
					<input id="task_id" type="hidden" class="form-control" name="task_id" value="">
					<input type="text" class="form-control" name="sub_task_name" placeholder="Add New Subtask..." autocomplete="off">
					<button class="btn" type="submit" name="add-sub-task-submit">ADD</button>
				</div>
			</form>

			<div class="sub-task-list"></div>

		</div>
		
		<div class="mt-3">
			<button class="btn" type="button" data-bs-dismiss="offcanvas">Close</button>
		</div>
	</div>
</div>

<!-- Modal -->
<form id="add-task" method="POST">
	<div class="modal modal-blur fade" id="modal-task" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">New task</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Name</label>
						<input type="text" class="form-control" name="task_name" placeholder="Task name" required autocomplete="off">
					</div>
					<div class="row">
						<div class="col-lg-8">
							<div class="mb-3">
								<label class="form-label">Assigned to</label>
								<input class="form-control" list="users" name="assigned_to" placeholder="Type to search..." required autocomplete="off">
								<?php echo get_cat_user_list(); ?>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="mb-3">
								<label class="form-label">Priority</label>
								<select class="form-select" name="task_priority" required>
									<option value="1" selected>Low</option>
									<option value="2">Medium</option>
									<option value="3">High</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="mb-3">
								<label class="form-label">Remainder date</label>
								<input type="date" class="form-control" name="remainder_date">
							</div>
						</div>
						<div class="col-lg-6">
							<div class="mb-3">
								<label class="form-label">Due date</label>
								<input type="date" class="form-control" name="due_date">
							</div>
						</div>
						<div class="col-lg-12">
							<div>
								<label class="form-label">Additional information</label>
								<textarea class="form-control" rows="3" name="note"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancel</a>
					<button type="submit" name="add_task_submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">Save</button>
				</div>
			</div>
		</div>
	</div>
</form>

<?php if ( check_project_type() ) { ?>
	<!-- Modal Share People -->
	<div class="modal modal-blur fade" id="modal-options" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Options Panel</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Name</label>
						<input type="text" class="form-control" name="task_name" value="<?php echo get_project_title(); ?>" placeholder="Project name" required autocomplete="off">
					</div>
					<div class="row">
						<div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
							<div class="assigned-user-list" ></div>
						</div>							
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="mb-3">
								<label class="form-label">Shared with</label>
								<input class="form-control" id="user_search" placeholder="Type to search..." autocomplete="off" />
							</div>
						</div>
					</div>

					<div class="row">
						<div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
							<div class="user-search-list" ></div>
						</div>							
					</div>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-primary link-secondary w-100" data-bs-dismiss="modal">Cancel</a>
					<?php if ( is_project_admin( $_REQUEST['category'] ) ) {
						echo '<button class="btn btn-danger w-100 my-3" onclick="deleteProject('. $_REQUEST['category'] .')">Delete Project</button>';
					} ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<?php
get_footer();