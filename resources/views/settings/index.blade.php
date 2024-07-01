<div class="modal-content tx-14">
    <form action="{{ route('settings.store') }}" method="POST" class="content_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
            <h6 class="modal-title" id="exampleModalLabel2">System Configuration</h6>
            <button type="button" class="btn btn-outline-dark btn-sm" data-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="site_name">Site Name <span class="text-danger">*</span></label>
                    <input type="text" name="site_name" id="site_name" class="form-control" required value="{{ get_option('site_name') }}">
                </div>
                
                <div class="col-md-4 form-group">
                    <label for="site_title">Site Title <span class="text-danger">*</span></label>
                    <input type="text" name="site_title" id="site_title" class="form-control" required value="{{ get_option('site_title') }}">
                </div>

                <div class="col-md-4 form-group">
                    <label for="prefix">Prefix <span class="text-danger">*</span></label>
                    <input type="text" name="prefix" id="prefix" class="form-control" required value="{{ get_option('prefix ') }}">
                </div>

                <div class="col-md-6 form-group">
                    <label for="logo">Logo</label>
                    <input type="file" name="logo" id="logo" class="form-control"> 
                    @if(get_option('logo'))
                        <img src="{{ asset('storage/logo/' . get_option('logo')) }}" alt="Logo" style="width: 250px;">
                        <input type="hidden" name="oldLogo" value="{{ get_option('logo') }}">
                    @endif
                </div>
    
                <div class="col-md-6 form-group">
                    <label for="favicon">Favicon </label>
                    <input type="file" name="favicon" id="favicon" class="form-control" >
                    @if(get_option('favicon'))
                        <img src="{{ asset('storage/logo/' . get_option('favicon')) }}" alt="favicon" style="width: 250px;">
                        <input type="hidden" name="old_favicon" value="{{ get_option('favicon') }}">
                    @endif
                </div>
    
                <div class="col-md-12 form-group">
                    <label for="meta_title">Meta Title <span class="text-danger">*</span></label>
                    <input type="text" name="meta_title" id="meta_title" class="form-control" required value="{{ get_option('meta_title') }}">
                </div>
    
                <div class="col-md-6 form-group">
                    <label for="meta_keyword">Meta Keyword <span class="text-danger">*</span></label>
                    <textarea name="meta_keyword" id="meta_keyword" cols="30" rows="4" class="form-control">{{ get_option('meta_keyword') }}</textarea>
                </div>
                
                <div class="col-md-6 form-group">
                    <label for="meta_description">Meta Description <span class="text-danger">*</span></label>
                    <textarea name="meta_description" id="meta_description" cols="30" rows="4" class="form-control">{{ get_option('meta_description') }}</textarea>
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