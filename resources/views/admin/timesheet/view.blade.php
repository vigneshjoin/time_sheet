<!-- Add / Edit Project Modal -->
<div class="modal fade" id="model_item">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Time sheet</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>

            <form action="{{ route('admin.timesheet.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  id="CreateForm"
                  onsubmit="return false;">
                @csrf

                <!-- Hidden fields for edit/update -->
                <input type="hidden" id="edit_action_url" value="{{ route('admin.timesheet.update', ':id') }}">
                <input type="hidden" name="_is_edit" id="_is_edit" value="0">
                <input type="hidden" id="edit_timesheet_id" value="">

                <div class="modal-body pb-0">
                    <div class="row">
                        <!-- Project ID -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="project_code" class="form-label">Project ID <span class="text-danger">*</span></label>
                                
                                 <select name="project_code" id="project_code" class="form-select form-select-md">
                                    <option value="">Select</option>
                                    @if(isset($projects))
                                        @foreach($projects as $project)
                                            <option value="{{ $project->project_id }}">{{  $project->project_id }}</option>
                                        @endforeach
                                    @endif
                                 </select>
                            </div>
                        </div>

                        <!-- User -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="staff_id" class="form-label">Staff <span class="text-danger">*</span></label>

                                <input type="text" readonly class="form-control form-control-md" name="staff_id" value="{{ $user->staff_id }}">

                                <!-- <select class="form-select form-select-md" id="user_id" name="user_id">
                                    <option value="">Select User</option>
                                    <option value="1">Vignesh</option>
                                    <option value="2">Swathi</option>
                                    <option value="3">Thanshika</option>
                                </select> -->

                            </div>
                        </div>

                        <!-- Entry Date -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="entry_date" class="form-label">Entry Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control form-control-md" 
                                    id="entry_date" name="entry_date" value="">
                            </div>
                        </div>

                        <!-- Hours Spent -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="hours_spent" class="form-label">Hours Spent <span class="text-danger">*</span></label>
                                <input type="number" class="form-control form-control-md" id="hours_spent" name="hours_spent" 
                                    placeholder="Enter hours (e.g., 1.5 for 1 hour 30 mins)">
                            </div>
                        </div>

                        <!-- Notes -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control form-control-md" 
                                        id="notes" name="notes" 
                                        placeholder="Enter any notes (optional)" rows="3"></textarea>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select form-select-md" id="status" name="status">
                                    <option value="">Select status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="SubmitBtn">Save Time sheet</button>
                </div> -->
            </form>
        </div>
    </div>
</div>
<!-- /Add / Edit Project Modal -->
