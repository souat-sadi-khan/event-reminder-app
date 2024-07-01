<div class="modal-content tx-14">
    <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel2">Update Event</h6>
        <button type="button" class="btn btn-xs btn-outline-dark" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12 table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <td>Completed?</td>
                        <td>
                            @if ($calendar->is_completed == 1)
                                <span class="badge badge-success">Yes</span>
                            @else
                                <span class="badge badge-danger">No</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td>{{ $calendar->title }}</td>
                    </tr>
                    <tr>
                        <td>Start Date</td>
                        <td>{{ $calendar->start_date . ' '. date('H:i', strtotime($calendar->start_time)) }}</td>
                    </tr>
                    <tr>
                        <td>End Date</td>
                        <td>{{ $calendar->end_date . ' '. date('H:i', strtotime($calendar->end_time)) }}</td>
                    </tr>
                    <tr>
                        <td>Exteral recipients</td>
                        <td>{{  $calendar->external_recipients }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">Notes</td>
                    </tr>
                    <tr>
                        <td colspan="2">{{ $calendar->notes }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
    </div>
</div>