<div class="modal-content tx-14">
    <form action="{{ route('calendars.update', $calendar->id) }}" method="POST" class="content_form">
        @csrf
        @method('PUT')
        <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel2">Update Event</h6>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" required value="{{ $calendar->title }}">
                </div>

                <div class="col-md-3 form-group">
                    <label for="start_date">Start date <span class="text-danger">*</span></label>
                    <input type="text" name="start_date" id="start_date" class="form-control date" required value="{{ $calendar->start_date }}">
                </div>

                <div class="col-md-3 form-group">
                    <label for="start_time">Start time <span class="text-danger">*</span></label>
                    <input type="text" name="start_time" id="start_time" class="form-control time" required value="{{ date('H:i', strtotime($calendar->start_time)) }}">
                </div>

                <div class="col-md-3 form-group">
                    <label for="end_date">End date <span class="text-danger">*</span></label>
                    <input type="text" name="end_date" id="end_date" class="form-control date" required value="{{ $calendar->end_date }}">
                </div>

                <div class="col-md-3 form-group">
                    <label for="end_time">End time <span class="text-danger">*</span></label>
                    <input type="text" name="end_time" id="end_time" class="form-control time" required value="{{ date('H:i', strtotime($calendar->end_time)) }}">
                </div>

                <div class="col-md-12 form-group">
                    <label for="external_recipients">External Recipients</label>
                    <input type="text" name="external_recipients" id="external_recipients" class="form-control tags" value="{{ $calendar->external_recipients }}">
                    <small class="text-danger">Use 'tab' key to add multiple</small>
                </div>

                <div class="col-md-12 form-group">
                    <label for="notes">Notes</label>
                    <textarea name="notes" id="notes" cols="30" rows="4" class="form-control">{{ $calendar->notes }}</textarea>
                </div>

                <div class="col-md-12 form-group">
                    <label for="is_completed">Is Completed? <span class="text-danger">*</span></label>
                    <select name="is_completed" id="is_completed" class="form-control select">
                        <option {{ $calendar->is_completed == 1 ? 'selected' : '' }} value="1">Yes</option>
                        <option {{ $calendar->is_completed == 0 ? 'selected' : '' }} value="0">No</option>
                    </select>
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