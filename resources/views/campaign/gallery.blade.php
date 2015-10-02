
@push('styles')
<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
<link href="{{ asset('/plugins/mini-upload-form/assets/css/style.css') }}" rel="stylesheet" />
@endpush
 <div class="modal fade" id="gallaryModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Gallary</h4>
            </div>
            <div class="modal-body">
               <form id="upload" method="post" action="{{url('galleryFileUpload')}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <div id="drop">
                    Drop Here

                    <a>Browse</a>
                    <input type="file" name="upl" multiple accept="image/*" />
                </div>

                <ul>
                    <!-- The file uploads will be shown here -->
                </ul>

              </form>
            </div>
            <div class="modal-footer">
<!--                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
        </div>
    </div>
</div>               
@push('scripts')
<script src="{{ asset('/plugins/mini-upload-form/assets/js/jquery.knob.js') }}"></script>
<script src="{{ asset('/plugins/mini-upload-form/assets/js/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('/plugins/mini-upload-form/assets/js/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('/plugins/mini-upload-form/assets/js/jquery.fileupload.js') }}"></script>
<script src="{{ asset('/plugins/mini-upload-form/assets/js/jquery.fileupload-validate.js') }}"></script>
<script src="{{ asset('/plugins/mini-upload-form/assets/js/script.js') }}"></script>
@endpush