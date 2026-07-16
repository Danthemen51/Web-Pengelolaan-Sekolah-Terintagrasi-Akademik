<div class="modal fade" id="pengumumanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="pengumumanTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p id="pengumumanIsi" class="mb-0"></p>
            </div>
        </div>
    </div>
</div>
<script>
    function showPengumuman(judul, isi) {
        document.getElementById('pengumumanTitle').innerText = judul;
        document.getElementById('pengumumanIsi').innerText = isi;
        new bootstrap.Modal(document.getElementById('pengumumanModal')).show();
    }
</script>

