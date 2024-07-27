@extends('adminlte::page')

@section('title', 'Siswa')

@section('content_header')
<button type="button" class="btn btn-primary btn-xs" id="create-student"><i class="fas fa-plus"></i> Tambah
    Siswa</button>
<span class="float-right header-name">SISWA</span>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-sm" id="student-table" style="width: 100%">
                <thead>
                    <tr class="bg-primary">
                        <th scope="col">Nama</th>
                        <th scope="col">Foto</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Kelamin</th>
                        <th scope="col">Telpon</th>
                        <th scope="col">Email</th>
                        <th scope="col" width="80px">Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

{{-- modal for student --}}
<div class="modal fade" id="student-modal" tabindex="-1" aria-labelledby="student-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="student-modalLabel">-</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="student-modal-footer">-</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script src="{{mix('js/master_data/index.js')}}"></script>
@stop