<div class="modal fade" id="autoPopupModal" tabindex="-1" aria-labelledby="autoPopupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title text-dark" id="addYearModalLabel">
                    <i class="fas fa-bell" style="font-size: 1em;"></i> <span style="font-size: 1em;">Announcement</span>
                </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {{-- <textarea class="summernote-simple" readonly>{!! strip_tags($annoucement->announcement) !!}</textarea> --}}
                    <textarea class="summernote-simple" readonly>{!! $annoucement->announcement !!}</textarea>
                </div>
                <div class="form-group">
                    {{-- <div class="row justify-content-center">
                        <div class="col-md-5">
                            <div class="date-box p-2">
                                <strong>{{ date('F d, Y', strtotime($annoucement->datestart)) }}</strong>
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-center justify-content-center">
                            <span class="date-separator">To</span>
                        </div>
                        <div class="col-md-5">
                            <div class="date-box p-2">
                                <strong>{{ date('F d, Y', strtotime($annoucement->dateend)) }}</strong>
                            </div>
                        </div>
                    </div> --}}
                    <div id="countdown" class="col-md-12" style="padding-top: 20px; text-align: center;">
                        <div style="color: rgb(80, 80, 80); font-size: 24px; font-family: 'Arial', sans-serif;">Remaining Time:</div>
                        <div class="countdown-container" style="font-size: 50px; font-weight: bold; color: black;">
                            <span id="hoursBox">00</span> :
                            <span id="minutesBox">00</span> :
                            <span id="secondsBox">00</span>
                        </div>
                        <div style="font-size: 10px; color: gray; text-align: center;">
                            <span style="margin: 20px;">Hours</span>
                            <span style="margin: 20px;">Minutes</span>&nbsp;&nbsp;&nbsp;&nbsp;
                            <span style="margin-right: -10px;">Seconds</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>