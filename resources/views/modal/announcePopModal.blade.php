<div class="modal fade" id="autoPopupModal" tabindex="-1" aria-labelledby="autoPopupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="autoPopupModalHeaderLabel">Announcement</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card overflow-hidden bg-light">
                    <div class="row align-items-center g-0">
                        <div class="col-md-4 text-center p-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/3652/3652191.png" class="img-fluid" style="max-height: 220px;">
                        </div>
                        <div class="col-md-8 p-4 text-center text-md-start">
                            <span class="badge bg-secondary px-3 py-2 mb-3">ANNOUNCEMENT</span>
                            <h1 class="fw-bold text-success mb-2" style="font-size: 2.5rem;">
                                PR IS CLOSED
                            </h1>
                            <p class="text-muted mb-3">
                                Please be informed that the PR period is now closed.
                            </p>
                            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-start gap-3">
                                <div class="bg-white shadow-sm rounded-3 px-4 py-2 text-center">
                                    <div class="text-muted small">START DATE</div>
                                    <div class="fw-bold text-success">
                                        {{ date('F d, Y', strtotime($annoucement->datestart)) }}
                                    </div>
                                </div>
                                <div class="fw-bold text-muted">—</div>
                                <div class="bg-white shadow-sm rounded-3 px-4 py-2 text-center">
                                    <div class="text-muted small">END DATE</div>
                                    <div class="fw-bold text-danger">
                                        {{ date('F d, Y', strtotime($annoucement->dateend)) }}
                                    </div>
                                </div>
                            </div>
                            <p class="mt-4 text-muted">
                                Thank you to everyone who participated and supported!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

