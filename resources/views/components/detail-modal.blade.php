<div class="modal fade" id="detailModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail URL - <span id="title-head"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="row g-1 mb-3">
                        <div class="col-md-9">
                            <div>
                                <label for="shortened_url" class="form-label">Shortened URL</label>
                                <input type="url" class="form-control" name="shortened_url" id="shortened-url-show" readonly>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div>
                                <label for="click_url" class="form-label">Total Click URL</label>
                                <input type="text" class="form-control" name="click_url" id="click-url-show" readonly>
                            </div>
                        </div>
                        <small class="text-danger">*Shortened URL and Total Click (Read Only)</small>
                    </div>
                    <div class="mb-3">
                        <label for="original_url" class="form-label">Original URL</label>
                        <input type="url" class="form-control" name="original_url" id="original-url-show" required>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="title-show">
                    </div>
                    <button type="submit" class="btn btn-primary">Update URL</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>