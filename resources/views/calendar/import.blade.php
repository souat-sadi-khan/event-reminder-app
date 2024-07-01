<div class="modal-content tx-14">
    <form action="{{ route('calendars.import') }}" method="POST" class="content_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel2">Import Events</h6>
            <button type="button" class="btn btn-sm btn-outline-dark" data-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12 form-group">
                    <p class="text-danger">Only Allowed file type is <b>CSV, TXT</b>. You can download the demo version of csv file from <a href="{{ asset('demo-csv-files-for-event-uploads.csv') }}" download>clicking</a> here.</p>
                </div>

                <div class="col-md-12 form-group">
                    <label for="file">Choose CSV file <span class="text-danger">*</span></label>
                    <input type="file" name="file" id="file" required class="form-control">
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