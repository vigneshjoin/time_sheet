<!-- Add User Modal -->
<div class="modal fade" id="model_item">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
            <form action="{{ route('admin.users.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  id="userCreateForm"
                  onsubmit="return false;">
                @csrf
				<input type="hidden" id="edit_action_url" value="{{ route('admin.users.update', ':id') }}">

				<meta name="csrf-token" content="{{ csrf_token() }}">
				<input type="hidden" id="image_folder" value="{{ asset('storage') }}">
				<input type="hidden" name="_is_edit" id="_is_edit" value="0">

				<input type="hidden" id="edit_user_id" value="">
                <div class="modal-body pb-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="Name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-md" 
                                       id="Name" name="name" 
                                       placeholder="Enter full name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="userEmail" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control form-control-md" 
                                       id="userEmail" name="email" 
                                       placeholder="Enter email address">
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-md" 
                                       id="username" name="user_name" 
                                       placeholder="Enter username">
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="companyName" class="form-label">Company Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-md" 
                                       id="companyName" name="company_name" 
                                       placeholder="Enter company name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="staffId" class="form-label">Staff ID <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-md" 
                                       id="staffId" name="staff_id" 
                                       placeholder="Enter staff ID">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="hourlyCharges" class="form-label">Hourly Charges <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" class="form-control form-control-md" 
                                       id="hourlyCharges" name="hourly_charges" 
                                       placeholder="Enter hourly rate">
                            </div>
                        </div>
                        <div class="col-md-6 password-field">
                            <div class="mb-3">
                                <label for="userPassword" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control form-control-md" 
                                       id="userPassword" name="password" 
                                       placeholder="Enter password">
                            </div>
                        </div>
                        <div class="col-md-6 password-field">
                            <div class="mb-3">
                                <label for="passwordConfirm" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control form-control-md" 
                                       id="passwordConfirm" name="password_confirmation" 
                                       placeholder="Confirm password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="userStatus" class="form-label">Status</label>
                                <select class="form-select form-select-md" id="userStatus" name="status">
                                    <option value="">Select Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="userRole" class="form-label">Role</label>
                                <select class="form-select form-select-md" id="userRole" name="user_type">
                                    <option value="">Select Role</option>
                                    <option value="staff">Staff</option>
                                    <option value="admin">Admin</option>
                                    <option value="super_admin">Super Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" style="display: none;">
                            <div class="mb-3">
                                <label for="userAvatar" class="form-label">Profile Image</label>
                                <input type="file" class="form-control form-control-md" 
                                       id="userAvatar" name="avatar" 
                                       accept="image/*">

								<img src="" alt="profile image" style="max-width: 100px; margin-top: 10px;" class="preview-image" style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="UserSubmitBtn">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- /Add User Modal -->

