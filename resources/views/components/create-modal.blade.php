 <div class="modal fade" id="shortenUrlModal" tabindex="-1" aria-labelledby="shortenUrlModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shortenUrlModalLabel">Shorten Your URL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('shorten') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="original_url" class="form-label">Original URL</label>
                        <input type="url" class="form-control" name="original_url" id="original_url" required>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title (Optional)</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                    <button type="submit" class="btn btn-primary">Shorten URL</button>
                </form>
            </div>
        </div>
    </div>
</div>