<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="container modal-content  mt-5">
            <div class="modal-header">
                <h4 class="change-modal-title">Change Password</h4>
                <button type="button" class="btn-close custom-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ti ti-x"></i>
                </button>
            </div>
             <form class="container mb-3" action="{{ route('admin.change-password') }}" id="pwdForm" novalidate onsubmit="return false;">
                @csrf
                
                <div class="mb-3">
                <label class="form-label">Current password</label>
                <input type="password" id="cur" class="form-control" name="cur" required>
                </div>

                <div class="mb-3">
                <label class="form-label">New password</label>
                    <input type="password" id="newpwd" class="form-control" name="newpwd" minlength="8" required>
                    <div class="form-text">Minimum 8 characters</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Confirm new password</label>
                    <input type="password" id="conf" class="form-control" name="conf" required>
                </div>

                <!-- button align right -->
                <button class="btn btn-primary float-end" id="saveBtn">Save</button>
          </form>
        </div>
    </div>
</div>
<!-- /Change Password Modal -->

