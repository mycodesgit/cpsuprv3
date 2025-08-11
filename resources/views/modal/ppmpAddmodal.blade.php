<div class="modal fade" id="addYearPPMPModal" tabindex="-1" role="dialog" aria-labelledby="addYearPPMPModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addYearPPMPModalLabel">Create New PPMP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="adYear" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addYearPPMPName">Year</label>
                        <select name="" id="" class="form-control">
                            <option disabled selected> --Select Year-- </option>
                            @foreach ($prppmpyear as $datapryear)
                                <option value="{{ $datapryear->id }}">{{ $datapryear->pryear }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>