<!DOCTYPE html>
<html lang="tr">
<head>
    <title>ÖĞRENCİLER</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container mt-5">
    <button type="button" class="btn btn-primary mb-3 btnModal" >Öğrenci Ekle</button>
    <table class="table table-bordered data-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>TC KİMLİK NO</th>
            <th>AD</th>
            <th>SOYAD</th>
            <th>OKUL ADI</th>
            <th>OKUL NO</th>
            <th>İŞLEMLER</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Öğrenci</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">TC Kimlik No:</label>
                        <input type="number" class="form-control" maxlength="11" name="identity_number">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Öğrenci Adı:</label>
                        <input type="text" class="form-control" name="student_name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Öğrenci Soyadı:</label>
                        <input type="text" class="form-control" name="student_surname">
                    </div>
                    <div class="form-group">
                        <label for="school_name" class="col-form-label">Okul Adı:</label>
                        <input type="text" class="form-control" name="school_name">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Okul No:</label>
                        <input type="number" class="form-control" maxlength="11" name="student_number">
                    </div>
                    <input type="hidden" name="id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                <button type="button" class="btn btn-primary btnAdd">Ekle</button>
                <button type="button" class="btn btn-primary btnUpdate">Güncelle</button>

            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var editor;
        var form = $('.form');
        var modal = $('.modal');
        var body = $('body');
        var btnUpdate = $('.btnUpdate'),
            btnAdd = $('.btnAdd');
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            stateSave: true,
            deferRender: true,
            select: true,
            ajax: "api/students",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'identity_number', name: 'identity_number'},
                {data: 'student_name', name: 'student_name'},
                {data: 'student_surname', name: 'student_surname'},
                {data: 'school_name', name: 'school_name'},
                {data: 'student_number', name: 'student_number'},
                {data: 'action', name: 'action', orderable: true, searchable: true},

            ]
        });
        body.on('click', '.delete', function () {
            if (confirm("Öğrenciyi Silmek İstediğinizden Emin misiniz?") == true) {
                var t = $(this);
                var id = t.data('id');
                $.ajax({ type:"DELETE", url: "api/students", data:{id:id}, dataType:'json', success: function(res){ var oTable = $('#datatable-crud').dataTable(); oTable.fnDraw(false);t.parent().parent().remove().empty();}
                });
            }
        });
        body.on('click','.btnModal',function (e){
            form.trigger('reset')
            modal.find('.modal-title').text('Öğrenci Ekle');
            btnAdd.show();
            btnUpdate.hide()
            modal.modal();
        });
        body.on('click', '.btnAdd', function (e) {
           e.preventDefault();
           btnUpdate.hide();
           var data = form.serialize();
            $.ajax({ type: "post", url: "api/students", data: data,dataType:'json', success: function (data) { if (data.success) { table.draw(); form.trigger("reset"); modal.modal('hide');}  else { console.log(data); }}
            });
        });
        body.on('click','.edit',function (){
            modal.modal();
            btnAdd.hide();
            btnUpdate.show();
            modal.find('.modal-title').text('Öğrenci Düzenle');
            var rowData =  table.row($(this).parents('tr')).data();
            form.find('input[name="id"]').val(rowData.id);
            form.find('input[name="identity_number"]').val(rowData.identity_number);
            form.find('input[name="student_name"]').val(rowData.student_name);
            form.find('input[name="student_surname"]').val(rowData.student_surname);
            form.find('input[name="school_name"]').val(rowData.school_name);
            form.find('input[name="student_number"]').val(rowData.student_number);
        });
        btnUpdate.click(function(){
            if(!confirm("Bilgileri Güncellemek istediğinizden emin misiniz?")) return;
            var formData = form.serialize()+'&_method=PUT';
            var updateId = form.find('input[name="id"]').val();
            $.ajax({
                type: "PUT",
                url: "/api/students/" + updateId,
                data: formData,
                success: function (data) {
                    if (data.success) {
                        table.draw();
                        modal.modal('hide');
                    }
                    else{
                        console.log(data);
                    }
                }
            }); //end ajax
        })



    });

</script>
</body>
</html>
