<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Add Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="adItem" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addItemCategory">Category:</label>
                        <select id="addItemCategory" name="category_id" class="form-control select2bs4" data-placeholder="Select Category" style="width: 100%;">
                            <option value="">-- Select --</option>
                            @foreach ($category as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="addItemUnit">Unit Name</label>
                        <select id="addItemUnit" name="unit_id" class="form-control select2bs4" data-placeholder="Select Unit" style="width: 100%;">
                            <option value="">-- Select --</option>
                            @foreach ($unit as $u)
                                <option value="{{ $u->id }}">{{ $u->unit_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="addItemDescripName">Item Description</label>
                        <textarea rows="4" name="item_descrip" id="addItemDescripName" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="addItemCost">Item Cost</label>
                        <input type="text" name="item_cost" id="addItemCost" onkeyup="formatNumber(this);" class="form-control">
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