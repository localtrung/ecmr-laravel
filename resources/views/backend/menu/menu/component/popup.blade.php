<div id="createMenuCatalogue" class="modal fade">
  <form action="" class="form create-menu-catalogue" method="">

    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Thêm mới vị trí hiển thị menu</h4>
          </div>
          <div class="modal-body">
            <div class="form-error text-success"></div>
                <div class="row">
                    <div class="col-lg-12">
                        <label for="">Tên vị trí hiển thị</label>
                        <input type="text" class="form-control" value="" name="name">
                        <div class="error name"></div>
                    </div>
                    <div class="col-lg-12">
                        <label for="">Từ khóa</label>
                        <input type="text" class="form-control" value="" name="keyword">
                        <div class="error keyword"></div>
                    </div>
                </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" name="create" value="create" class="btn btn-success" >Lưu lại</button>
          </div>
        </div>
    </div>
  </form>
</div>
