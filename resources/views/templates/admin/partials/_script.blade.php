<!-- <script src="{{ asset('assets/js/oneui.core.min.js') }}"></script> -->

<!--
    OneUI JS

    Custom functionality including Blocks/Layout API as well as other vital and optional helpers
    webpack is putting everything together at assets/_es6/main/app.js
-->
<!-- <script src="{{ asset('assets/js/oneui.app.min.js') }}"></script> -->


<script type="text/javascript" src="{{ asset('assets/bs4/js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/bs4/js/dataTables.fixedColumns.min.js')}}"></script>


<!-- Page JS Plugins -->
<!-- <script src="{{ asset('assets/js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables/buttons/buttons.colVis.min.js') }}"></script> -->

<!-- Page JS Code -->
<!-- <script src="{{ asset('assets/js/pages/be_tables_datatables.min.js') }}"></script> -->

<!-- Page JS Plugins -->
<script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>

<!-- Page JS Helpers (Select2 plugin) -->


<!-- Page JS Code -->
<script src="{{ asset('assets/js/pages/be_forms_validation.min.js') }}"></script>

<!-- Page JS Plugins -->
<script src="{{ asset('assets/js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/dropzone/dropzone.min.js') }}"></script>

<!-- <script src="{{ asset('assets/js/plugins/jquery-ui-2/jquery-ui.min.js') }}"></script> -->


<!-- Page JS Helpers (BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Inputs + Ion Range Slider plugins) -->
<script>jQuery(function(){ One.helpers(['datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider']); });</script>

<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script> -->

<!-- <script type="text/javascript" src="{{ asset('assets/js/jquery.dataTables.min.js')}}"></script> -->

<!-- <script type="text/javascript" src="{{ asset('assets/js/dataTables.fixedColumns.min.js') }}"></script>-->
<!-- <script type="text/javascript" src="{{ asset('assets/js/plugins/jquery.maskedinput/jquery.maskedinput.min.js') }}"></script> -->

<!-- <script type="text/javascript">
    $(document).ready(function() {
        var table = $('#tb_rekap').DataTable( {
            scrollY:        "500px",
            scrollX:        true,
            scrollCollapse: true,
            paging:         false,
            
            fixedColumns:   {
                leftColumns: 3
            },

        } );
    } );
</script> -->
<script src="https://cdn.datatables.net/plug-ins/1.10.20/dataRender/datetime.js"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/jquery-validation/additional-methods.js') }}"></script>
<!-- Page JS Code -->
<script src="{{ asset('assets/js/pages/be_forms_validation.min.js') }}"></script>
<!-- <script src="{{ asset('assets/js/pages/be_pages_dashboard.min.js') }}"></script> -->
<!-- <script src="{{ asset('assets/js/plugins/jquery-validation/localization/message_id.js') }}"></script> -->
<script src="{{ asset('assets/js/plugins/jquery-validation/localization/messages_id.js') }}"></script>

@if(Request::is('home') || Request::is('transaction/add*'))
    <script type="text/javascript">
        var rupiah = document.getElementById("rupiah");
        rupiah.addEventListener("keyup", function(e) {

            rupiah.value = formatRupiah(this.value, "Rp. ");
        });

        
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);


            if (ribuan) 
            {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");}

            rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
            return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }

    </script>
@endif


<script>
    function formatDate (input) {
        var datePart = input.match(/\d+/g),
        year = datePart[0], // get only two digits
        month = datePart[1], 
        day = datePart[2];
        return day+'-'+month+'-'+year;
}
</script>

<!-- Menu Voucher -->
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function convertDate(dateString){
            var p = dateString.split(/\D/g)
            return [p[2],p[1],p[0] ].join("-")
        }

        // view data
        load_data();

        function load_data(from_date = '', to_date = '')
        {
            var table = $('#tb_voucher').DataTable({
                scrollY:        "70vh",
                scrollX:        true,
                scrollCollapse: true,
                pageLength: 50,
                processing: true,
                serverSide: true,
                language: {
                    processing: '<div class="wobblebar-loader"></div>',
                    sEmptyTable:   "Tidak ada data yang tersedia pada tabel ini",
                    sLengthMenu:   "Tampilkan _MENU_ entri",
                    sZeroRecords:  "Tidak ditemukan data yang sesuai",
                    sInfo:         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    sInfoEmpty:    "Menampilkan 0 sampai 0 dari 0 entri",
                    sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
                    sInfoPostFix:  "",
                    sSearch:       "Cari:",
                    sUrl:          "",
                    oPaginate: {
                        sFirst:    "Pertama",
                        sPrevious: "Sebelumnya",
                        sNext:     "Selanjutnya",
                        sLast:     "Terakhir"
                    },
                    
                },
                ajax: {
                    url: "{{ route('voucher.index') }}",
                    data:{from_date:from_date, to_date:to_date}
                },
                columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', sClass: 'text-center'},
                {data: 'kode_voucher', name: 'kode_voucher', sClass: 'text-center'},
                {data: 'nilai_fh', name: 'nilai_fh', sClass: 'text-center'},
                {data: 'status', name: 'status', sClass: 'text-center'},
                {data: 'aksi', name: 'aksi', sClass: 'text-center', orderable: false, searchable: false},
                ]

            });
        }

        //Filter & Refresh
        $('#filter').click(function(){
            var from_date = convertDate($('#from_date').val());
            var to_date = convertDate($('#to_date').val());
            if($('#from_date').val() != '' &&  $('#to_date').val() != '')
            {
                $('#tb_voucher').DataTable().destroy();
                load_data(from_date, to_date);
            }
            else{
                alert('Harap isi terlebih dahulu keduanya yah~');
            }
        });

        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $('#tb_voucher').DataTable().destroy();
            load_data();
        });
        
    });
</script>


<script type="text/javascript">
    setTimeout(function() {
        $(".alert").alert('close');
    }, 10000);
</script>




