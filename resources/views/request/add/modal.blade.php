<style>
    .select2-container .select2-selection--single {
        overflow: hidden;
        border: 1px solid #ced4da;
    }
</style>
<div class="modal fade" id="modal-purpose">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    <i class="fas fa-plus"></i> Add New
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form action="{{ route('prPurposeRequestCreate') }}" class="form-horizontal" method="post" id="purposepr">
                    @csrf
                    
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="camp_id" value="{{ Auth::user()->campus_id }}">
                    <input type="hidden" name="office_id" value="{{ Auth::user()->office_id }}">
                    <input type="hidden" name="transaction_no" value="{{ Auth::user()->office->office_abbr }}-{{ Str::random(3) }}{{ rand(100, 999) }}-{{ Str::random(3) }}-{{ now()->format('Y-m-d') }}">
                    
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Select Category</label><br>
                                <select class="form-control" name="cat_id" id="categorySelect" style="pointer-events: none;">
                                    <option disabled selected>Select</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Purpose:</label>
                                <input type="text" name="purpose_name" class="form-control" placeholder="Enter Purpose here">
                            </div>
                        </div>
                    </div>  
                    
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" name="btn-submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>   
                </form>
            </div>
            
            <div class="modal-footer justify-content-between">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>