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
<script src="{{ asset('script.js') }}"></script>
</body>
</html>
