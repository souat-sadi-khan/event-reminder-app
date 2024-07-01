<div class="modal-content tx-14">
    <form action="{{ route('calendars.store') }}" method="POST" class="content_form">
        @csrf
        <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel2">Create new Event</h6>
            <button type="button" class="btn btn-xs btn-outline-dark" data-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>

                <div class="col-md-3 form-group">
                    <label for="start_date">Start date <span class="text-danger">*</span></label>
                    <input type="text" name="start_date" id="start_date" class="form-control date" required value="{{ $startDate }}">
                </div>

                <div class="col-md-3 form-group">
                    <label for="start_time">Start time <span class="text-danger">*</span></label>
                    <input type="text" name="start_time" id="start_time" class="form-control time" required value="{{ date('H:i') }}">
                </div>

                <div class="col-md-3 form-group">
                    <label for="end_date">End date <span class="text-danger">*</span></label>
                    <input type="text" name="end_date" id="end_date" class="form-control date" required value="{{ $endDate }}">
                </div>

                <div class="col-md-3 form-group">
                    <label for="end_time">End time <span class="text-danger">*</span></label>
                    <input type="text" name="end_time" id="end_time" class="form-control time" required value="{{ date('H:i', strtotime(date('H:i:s')) + 1800) }}">
                </div>

                <div class="col-md-12 form-group">
                    <label for="external_recipients">External Recipients</label>
                    <input type="text" name="external_recipients" id="external_recipients" class="form-control tags">
                    <small class="text-danger">Use 'tab' key to add multiple</small>
                </div>

                <div class="col-md-12 form-group">
                    <label for="notes">Notes</label>
                    <textarea name="notes" id="notes" cols="30" rows="4" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
            <button type="submit" id="submit" class="btn btn-primary tx-13">Save</button>
            <button type="button" style="display: none;" id="submitting" disabled class="btn btn-primary tx-13">Processing <i class="fa fa-spin fa-spinner"></i></button>
        </div>
    </form>
</div>