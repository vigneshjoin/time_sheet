@php

    $statusEditable = '';

    if($user->user_type == 'staff'){
        $statusEditable = 'readonly disabled ';
    }
@endphp

<!-- Add / Edit Project Modal -->
<div class="modal fade" id="model_item">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Project</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>

            <form action="{{ route('admin.projects.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  id="CreateForm"
                  onsubmit="return false;">
                @csrf

                <!-- Hidden fields for edit/update -->
                <input type="hidden" id="edit_action_url" value="{{ route('admin.projects.update', ':id') }}">
                <input type="hidden" name="_is_edit" id="_is_edit" value="0">
                <input type="hidden" id="edit_project_id" value="">

                <div class="modal-body pb-0">
                    <div class="row">
                        <!-- Project ID -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="project_id" class="form-label">Project ID <span class="text-danger">*</span></label>
                                <input type="text" {{ $statusEditable }} class="form-control form-control-md" 
                                       id="project_id" name="project_id" 
                                       placeholder="Enter unique project ID">
                            </div>
                        </div>

                        <!-- Project Name -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="project_name" class="form-label">Project Name <span class="text-danger">*</span></label>
                                <input type="text" {{ $statusEditable }} class="form-control form-control-md" 
                                       id="project_name" name="project_name" 
                                       placeholder="Enter project name">
                            </div>
                        </div>

                        <!-- Project Users -->
                        @if($user->user_type != 'staff')
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="project_users" class="form-label">Assign Users <span class="text-danger">*</span></label>
                                <select {{ $statusEditable }} class="form-select form-select-md select2" 
                                        id="project_users" 
                                        name="project_users[]" 
                                        multiple
                                        data-placeholder="Select users to assign">
                                    @foreach($users ?? [] as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Select multiple users who will work on this project</small>
                            </div>
                        </div>
                        @endif

                        <!-- Description -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea {{ $statusEditable }} class="form-control form-control-md" 
                                          id="description" name="description" 
                                          placeholder="Enter project description" rows="3"></textarea>
                            </div>
                        </div>

                        <!-- Start Date -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="start_date" class="form-label">Project Start Date <span class="text-danger">*</span></label>
                                <input {{ $statusEditable }} type="date" class="form-control form-control-md" 
                                       id="start_date" name="start_date">
                            </div>
                        </div>

                        <!-- Due Date -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="due_date" class="form-label">Project Due Date <span class="text-danger">*</span></label>
                                <input {{ $statusEditable }} type="date" class="form-control form-control-md" 
                                       id="due_date" name="due_date">
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select form-select-md" id="status" name="status">
                                    <option value="">Select status</option>
                                    <option value="Yet to Start">Yet to Start</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                    <option value="On Hold">On Hold</option>
                                </select>
                            </div>
                        </div>

                        
                    </div>
                </div>

                @if($user_type == 'admin' || $user_type == 'super_admin' )
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="SubmitBtn">Save Project</button>
                    </div>
                @endif

                @if($user_type == 'staff')
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="updateSubmitBtn">Update</button>
                   </div>
                @endif
            </form>
        </div>
    </div>
</div>
<!-- /Add / Edit Project Modal -->
