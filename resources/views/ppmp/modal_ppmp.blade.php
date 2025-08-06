<div class="modal fade" id="modal-userppmp{{ $data->puid }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Select
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form class="form-horizontal" action="{{ route('userppmpUpdate', ['id' => $data->puid]) }}" method="post" id="addUser">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->puid }}">

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Select Category Based on PPMP Approved:</label>
                                <select name="ppmp_categories[]" class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if($data->ppmp_categories && in_array($category->id, json_decode($data->ppmp_categories))) selected @endif>{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <!-- Additional buttons or content if needed -->
            </div>
        </div>
    </div>
</div>