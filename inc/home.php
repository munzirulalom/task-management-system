<?php
/* Previent Direct Access */
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

$categories = get_table_name('category');
$user_task = get_table_name('category_user');
$user_id = (int) $_SESSION['id'];

$stmt = $db->prepare("SELECT ct.* FROM `{$user_task}` AS ut LEFT JOIN `{$categories}` AS ct ON ut.cat_id= ct.cat_id WHERE ut.user_id = {$user_id}");
$stmt->execute();
?>

<div class="container-xl">
	<div class="row row-deck row-cards">

		<?php while ($project = $stmt->fetch(PDO::FETCH_ASSOC) ) { ?>

			<div class="col-md-6 col-xl-3">
				<a class="card card-link" href="<?php echo SITE_URL.'/task/'. $project['cat_id'] ?>">
					<div class="card-body">
						<div class="row">
							<div class="col-auto">
								<span class="avatar rounded"><?php echo substr($project['cat_title'],0,3) ?></span>
							</div>
							<div class="col">
								<div class="font-weight-medium"><?php echo $project['cat_title']; ?></div>
								<div class="text-muted"><?php echo $project['cat_type'] == 1 ? "Personal" : "Project"; ?></div>
							</div>
						</div>
					</div>
				</a>
			</div>

		<?php } ?>

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

			<label class="form-selectgroup-item flex-fill">
				<input type="checkbox" name="form-project-manager[]" value="1" class="form-selectgroup-input">
				<div class="form-selectgroup-label d-flex align-items-center p-3">
					<div class="me-3">
						<span class="form-selectgroup-check"></span>
					</div>
					<div class="form-selectgroup-label-content d-flex align-items-center">
						<div>
							<div class="font-weight-medium">Sub Task 1</div>
							<div class="text-muted">
								<span class="icon-size-1 me-1"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-minus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
									<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
									<rect x="4" y="5" width="16" height="16" rx="2"></rect>
									<line x1="16" y1="3" x2="16" y2="7"></line>
									<line x1="8" y1="3" x2="8" y2="7"></line>
									<line x1="4" y1="11" x2="20" y2="11"></line>
									<line x1="10" y1="16" x2="14" y2="16"></line>
								</svg></span>
								<span>Sat, Feb 12, 2022</span>
							</div>
						</div>
					</div>
				</div>
			</label>
			<label class="form-selectgroup-item flex-fill">
				<input type="checkbox" name="form-project-manager[]" value="1" class="form-selectgroup-input">
				<div class="form-selectgroup-label d-flex align-items-center p-3">
					<div class="me-3">
						<span class="form-selectgroup-check"></span>
					</div>
					<div class="form-selectgroup-label-content d-flex align-items-center">
						<div>
							<div class="font-weight-medium">Sub Task 2</div>
							<div class="text-muted">
								<span class="icon-size-1 me-1"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-minus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
									<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
									<rect x="4" y="5" width="16" height="16" rx="2"></rect>
									<line x1="16" y1="3" x2="16" y2="7"></line>
									<line x1="8" y1="3" x2="8" y2="7"></line>
									<line x1="4" y1="11" x2="20" y2="11"></line>
									<line x1="10" y1="16" x2="14" y2="16"></line>
								</svg></span>
								<span>Sat, Feb 12, 2022</span>
							</div>
						</div>
					</div>
				</div>
			</label>
			<label class="form-selectgroup-item flex-fill">
				<input type="checkbox" name="form-project-manager[]" value="1" class="form-selectgroup-input">
				<div class="form-selectgroup-label d-flex align-items-center p-3">
					<div class="me-3">
						<span class="form-selectgroup-check"></span>
					</div>
					<div class="form-selectgroup-label-content d-flex align-items-center">
						<div>
							<div class="font-weight-medium">Sub Task 3</div>
							<div class="text-muted">
								<span class="icon-size-1 me-1"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-minus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
									<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
									<rect x="4" y="5" width="16" height="16" rx="2"></rect>
									<line x1="16" y1="3" x2="16" y2="7"></line>
									<line x1="8" y1="3" x2="8" y2="7"></line>
									<line x1="4" y1="11" x2="20" y2="11"></line>
									<line x1="10" y1="16" x2="14" y2="16"></line>
								</svg></span>
								<span>Sat, Feb 12, 2022</span>
							</div>
						</div>
					</div>
				</div>
			</label>

		</div>
		<div class="mt-3">
			<button class="btn" type="button" data-bs-dismiss="offcanvas">
				Close offcanvas
			</button>
		</div>
	</div>
</div>

<!-- Modal -->
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
					<input type="text" class="form-control" name="example-text-input" placeholder="Your task name">
				</div>
				<label class="form-label">task type</label>
				<div class="form-selectgroup-boxes row mb-3">
					<div class="col-lg-6">
						<label class="form-selectgroup-item">
							<input type="radio" name="task-type" value="1" class="form-selectgroup-input" checked>
							<span class="form-selectgroup-label d-flex align-items-center p-3">
								<span class="me-3">
									<span class="form-selectgroup-check"></span>
								</span>
								<span class="form-selectgroup-label-content">
									<span class="form-selectgroup-title strong mb-1">Simple</span>
									<span class="d-block text-muted">Provide only basic data needed for the task</span>
								</span>
							</span>
						</label>
					</div>
					<div class="col-lg-6">
						<label class="form-selectgroup-item">
							<input type="radio" name="task-type" value="1" class="form-selectgroup-input">
							<span class="form-selectgroup-label d-flex align-items-center p-3">
								<span class="me-3">
									<span class="form-selectgroup-check"></span>
								</span>
								<span class="form-selectgroup-label-content">
									<span class="form-selectgroup-title strong mb-1">Advanced</span>
									<span class="d-block text-muted">Insert charts and additional advanced analyses to be inserted in the task</span>
								</span>
							</span>
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<div class="mb-3">
							<label class="form-label">task url</label>
							<div class="input-group input-group-flat">
								<span class="input-group-text">
									https://tabler.io/tasks/
								</span>
								<input type="text" class="form-control ps-0"  value="task-01" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="mb-3">
							<label class="form-label">Visibility</label>
							<select class="form-select">
								<option value="1" selected>Private</option>
								<option value="2">Public</option>
								<option value="3">Hidden</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">Client name</label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-lg-6">
						<div class="mb-3">
							<label class="form-label">tasking period</label>
							<input type="date" class="form-control">
						</div>
					</div>
					<div class="col-lg-12">
						<div>
							<label class="form-label">Additional information</label>
							<textarea class="form-control" rows="3"></textarea>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
					Cancel
				</a>
				<a href="#" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
					<!-- Download SVG icon from http://tabler-icons.io/i/plus -->
					<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
					Create new task
				</a>
			</div>
		</div>
	</div>
</div>

<?php get_footer() ?>