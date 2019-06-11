<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="orderModalLabel">Order Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id = "orderModalWrapper"></div>
        <form id = "formOrderModal" action = "" method = "post">
          <div class="form-group">
            <label for="orderStatus" class="col-form-label">Status:</label>
            <select class="form-control" id="orderStatus" required>
                <option value = 'pending'>Pending</option>
                <option value = 'success'>Success</option>
                <option value = 'failed'>Failed</option>
                <option value = 'expired'>Expired</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id = "update-order-status" onclick = "updateOrderStatus(this);">Update Order Status</button>
      </div>
    </div>
  </div>
</div>