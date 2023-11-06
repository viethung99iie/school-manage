<div class="col-md-4">
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
          <div class="modal-body p-0">
            @csrf
            <div class="card card-plain">
              <div class="card-header pb-0 text-center">
                <h5 class="font-weight-bolder">Thay đổi mật khẩu</h5>
              </div>
              <div class="card-body">
                <form role="form text-left">
                  <label>Mật khẩu hiện tại</label>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" name="old_password" placeholder="Mật khẩu" aria-label="Email" aria-describedby="email-addon">
                  </div>
                  <label>Mật khẩu mới</label>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" name="new_password"  placeholder="Mật khẩu mới" aria-label="Password" aria-describedby="password-addon">
                  </div>
                  <label>Xác nhận mật khẩu</label>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" name="confirm_password"  placeholder="Xác nhận mật khẩu" aria-label="Password" aria-describedby="password-addon">
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">Lưu thay đổi</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
