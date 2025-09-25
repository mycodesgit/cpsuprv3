<div class="modal fade" id="modal-addOtherAnnounceModal" tabindex="-1" role="dialog" aria-labelledby="addOtherAnnounceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOtherAnnounceModalLabel">Add Other Announcement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="adOtherAnnounce" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="oannounce">Other Announcement</label>
                        <textarea id="summernoteother" id="oannounce" name="otherannouncement"></textarea>
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