<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkoutModalLabel">Transaction details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id = "formCheckoutModal" action = "" method = "post">
          <div class="form-group">
            <label for="address" class="col-form-label">Address:</label>
            <textarea class="form-control" id="address" required></textarea>
          </div>
          <div class="form-group">
            <label for="city" class="col-form-label">City:</label>
            <input class="form-control" id="city" required>
          </div>
          <div class="form-group">
            <label for="phone" class="col-form-label">Phone:</label>
            <input class="form-control" id="phone" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id = "proceed-to-payment">Proceed to payment</button>
      </div>
    </div>
  </div>
</div>