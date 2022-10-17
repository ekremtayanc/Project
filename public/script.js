$(function () {
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // DELETE STUDENT AJAX
    body.on('click', '.delete', function () {
        if (confirm("Öğrenciyi Silmek İstediğinizden Emin misiniz?") == true) {
            var t = $(this);
            var id = t.data('id');
            $.ajax({ type:"DELETE", url: "api/students", data:{id:id}, dataType:'json', success: function(res){ var oTable = $('#datatable-crud').dataTable(); oTable.fnDraw(false);t.parent().parent().remove().empty();}
            });
        }
    });
    // CREATE STUDENT FORM MODAL OPENER
    body.on('click','.btnModal',function (e){
        form.trigger('reset')
        modal.find('.modal-title').text('Öğrenci Ekle');
        btnAdd.show();
        btnUpdate.hide()
        modal.modal();
    });
    // CREATE STUDENT AJAX
    body.on('click', '.btnAdd', function (e) {
        e.preventDefault();
        btnUpdate.hide();
        var data = form.serialize();
        $.ajax({ type: "post", url: "api/students", data: data,dataType:'json', success: function (data) { if (data.success) { table.draw(); form.trigger("reset"); modal.modal('hide');}  else { console.log(data); }}
        });
    });
    //EDIT STUDENT FORM MODAL OPENER
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
    //EDIT USER AJAX
    btnUpdate.click(function(){
        if(!confirm("Bilgileri Güncellemek istediğinizden emin misiniz?")) return;
        var formData = form.serialize()+'&_method=PUT';
        var updateId = form.find('input[name="id"]').val();
        $.ajax({ type: "PUT", url: "/api/students/" + updateId, data: formData, success: function (data) { if (data.success) { table.draw(); modal.modal('hide'); }  else { console.log(data);} }/* success function end */ }); //end ajax
    });



});
