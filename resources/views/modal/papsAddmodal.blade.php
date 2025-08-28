<div class="modal fade" id="addYearPAPsModal" tabindex="-1" role="dialog" aria-labelledby="addYearPAPsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addYearPAPsModalLabel">Create New PAP's</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="adYearPaps" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addYearPAPsName">Year</label>
                        <select name="papsyearid" id="papsyearid" class="form-control" onchange="updatePapsYearName()">
                            <option disabled selected> --Select Year-- </option>
                            @foreach ($prppmpyear as $datapryear)
                                <option value="{{ $datapryear->id }}" data-year="{{ $datapryear->pryear }}">{{ $datapryear->pryear }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="papsyearname" id="papsyearname">
                    </div>
                    <div class="form-group">
                        <label for="papsuserfundsource">Fund Source</label>
                        <select name="papsuserfundsource" id="papsuserfundsource" class="form-control">
                            <option disabled selected> --Select -- </option>
                            <option value="GAA"> GAA </option>
                            <option value="Income"> Income </option>
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

<script>
    function updatePapsYearName() {
        let select = document.getElementById('papsyearid');
        let selectedOption = select.options[select.selectedIndex];
        document.getElementById('papsyearname').value = selectedOption.getAttribute('data-year');
    }
</script>