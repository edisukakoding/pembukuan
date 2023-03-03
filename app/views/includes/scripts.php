</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="<?= BASE_URL . 'assets/vendors/js/vendor.bundle.base.js'; ?>"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- <script src="assets/vendors/chart.js/Chart.min.js"></script> -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="<?= BASE_URL . 'assets/js/off-canvas.js'; ?>"></script>
<script src="<?= BASE_URL . 'assets/js/hoverable-collapse.js'; ?>"></script>
<script src="<?= BASE_URL . 'assets/js/misc.js'; ?>"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<!-- <script src="assets/js/dashboard.js"></script> -->
<!-- <script src="assets/js/todolist.js"></script> -->
<!-- End custom js for this page -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function() {
    // data tabel
    // console.log($('th').reduce((th, i) => $(th).text() != 'Aksi'))
    $('#data').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                title: $('.title-export').text(),
                exportOptions: {
                    columns: $('th').map((i, th) => $(th).text() !== 'Aksi' ? i : null)
                }
            },
            {
                extend: 'pdfHtml5',
                title: $('.title-export').text(),
                customize: function (doc) {
                    doc.content[1].table.widths =
                        Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                },
                exportOptions: {
                    columns: $('th').map((i, th) => $(th).text() !== 'Aksi' ? i : null)
                }
            },
            {
                extend: 'print',
                title: $('.title-export').text(),
                exportOptions: {
                    columns: $('th').map((i, th) => $(th).text() !== 'Aksi' ? i : null)
                }
            }
        ]
    });

    // hilangkan DP
    if ($('#is_moons').is(':checked')) {
        $('#input-dp').css('display', 'none');
        $('#installment_id').prop('required', false)
    }

    $('#is_moons').on("click", function() {
        if ($(this).is(':checked')) {
            $('#input-dp').css('display', 'none');
            $('#installment_id').prop('required', false)
        } else {
            $('#input-dp').css('display', 'block');
            $('#installment_id').prop('required', true);
        }
    })

    $('#installment_id').on("change", function() {
        const product_id = $('#product_id').val();
        const installment_id = $('#installment_id').val();
        const qty = $('#qty').val();
        $.ajax({
            type: 'GET',
            url: `<?= BASE_URL; ?>transaction/hitung_angsuran/${product_id}/${installment_id}/${qty}`,
            success: function(res) {
                const data = JSON.parse(res)
                $('#tabel-angsuran').html(`
                    <table class="table table-bordered">
                        <tr>
                            <th>DP</th>
                            <td>Rp. ${parseFloat(data.dp).toFixed(2)}</td>
                        </tr>
                        <tr>
                            <th>Perbulan</th>
                            <td>Rp. ${parseFloat(data.per_moon).toFixed(2)}</td>
                        </tr>
                    </table>
                `)
            }
        })
    })

    // report
    $('#report-transaction').on('submit', function(e) {
        e.preventDefault();
        const bulan = $('#bulan').val();
        const tahun = $('#tahun').val();
        window.location.href = `<?= BASE_URL . 'report/penjualan/'; ?>${bulan}/${tahun}`;
    })
})
</script>
</body>

</html>