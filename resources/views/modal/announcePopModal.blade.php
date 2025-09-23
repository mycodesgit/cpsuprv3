<div class="modal fade" id="autoPopupModal" tabindex="-1" aria-labelledby="autoPopupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content custom-modal">
            <div class="modal-body bgm">
                <div class="error-page">
                    <h2 class="headline text-warning"> </h2>
                    <div class="error-content" style="margin-left: 370px">
                        <h2><i class="fas fa-exclamation-circle text-success"></i> Announcement!</h2>
                        <h6 style="text-align: justify-all;">
                            {{ $annoucement->announcement }}
                        </h6>
                        <div class="search-form text-center" style="padding-top: 30px;">
                            <div class="row justify-content-center">
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
                            </div>
                        </div>
                        <div id="countdown" class="col-md-12" style="padding-top: 20px; text-align: center;">
                            <div style="color: rgb(80, 80, 80); font-size: 24px; font-family: 'Arial', sans-serif;">Remaining Time:</div>
                            <div class="countdown-container" style="font-size: 50px; font-weight: bold; color: black;">
                                <span id="hoursBox">00</span> :
                                <span id="minutesBox">00</span> :
                                <span id="secondsBox">00</span>
                            </div>
                            <div style="font-size: 14px; color: gray; text-align: center;">
                                <span style="margin: 20px;">Hours</span>
                                <span style="margin: 20px;">Minutes</span>&nbsp;&nbsp;&nbsp;&nbsp;
                                <span style="margin-right: -10px;">Seconds</span>
                            </div>
                        </div>
                                                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>