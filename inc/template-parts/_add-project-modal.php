<?php 
/* Previent Direct Access */
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="modal modal-blur fade" id="modal-add-project" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form id="add-project" action="ajax/add-project.php" method="POST">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">New project</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label">Name</label>
						<input type="text" class="form-control" id="project-name" name="project-name" placeholder="Your project name" required autocomplete="off">
					</div>
					<label class="form-label">project type</label>
					<div class="form-selectgroup-boxes row mb-3">
						<div class="col-lg-6">
							<label class="form-selectgroup-item">
								<input type="radio" id="project-type" name="project-type" value="1" class="form-selectgroup-input" checked>
								<span class="form-selectgroup-label d-flex align-items-center p-3">
									<span class="me-3">
										<span class="form-selectgroup-check"></span>
									</span>
									<span class="form-selectgroup-label-content">
										<span class="form-selectgroup-title strong mb-1">Simple</span>
										<span class="d-block text-muted">For personal usages. Team collaborations are not possible</span>
									</span>
								</span>
							</label>
						</div>
						<div class="col-lg-6">
							<label class="form-selectgroup-item">
								<input type="radio" id="project-type" name="project-type" value="2" class="form-selectgroup-input">
								<span class="form-selectgroup-label d-flex align-items-center p-3">
									<span class="me-3">
										<span class="form-selectgroup-check"></span>
									</span>
									<span class="form-selectgroup-label-content">
										<span class="form-selectgroup-title strong mb-1">Advanced</span>
										<span class="d-block text-muted">For team. Team collaborations are possible</span>
									</span>
								</span>
							</label>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
						Cancel
					</a>
					<button type="submit" class="btn btn-primary ms-auto" name="add-project-submit">
						<!-- Download SVG icon from http://tabler-icons.io/i/plus -->
						<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
						Create new project
					</button>
				</div>
			</div>
		</form>
		<div id="message"></div>
	</div>
</div>