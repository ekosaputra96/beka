@extends('adminlte::page')

@section('title', 'Siswa')

@section('content_header')
<button type="button" class="btn btn-success btn-xs" id="create-student"><i class="fas fa-plus"></i> Tambah
    Siswa</button>
<span class="float-right header-name">SISWA</span>
@stop

@section('plugins.TempusDominusBs4', true)

@section('content')
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-sm" id="student-table" style="width: 100%">
                <thead>
                    <tr class="bg-primary">
                        <th scope="col">Nama</th>
                        <th scope="col">Tgl. Lahir</th>
                        <th scope="col">NIS</th>
                        <th scope="col">Kelamin</th>
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
            <form id="student-form" autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title" id="student-modalLabel">-</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input name="nama" label="Nama :" placeholder="Nama..." igroup-size="sm"
                                required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-signature"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>

                        <div class="col-md-6">
                            <x-adminlte-input name="nis" label="NIS :" placeholder="NIS..." igroup-size="sm"
                                class="auto-caps">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-id-card"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                        </div>

                        <div class="col-md-6">
                            @php
                            $config = [
                            'format' => 'YYYY-MM-DD',
                            ];
                            @endphp
                            <x-adminlte-input-date name="tanggal_lahir" label="Tanggal Lahir :" igroup-size="sm"
                                :config="$config" placeholder="Tanggal Lahir...">
                                <x-slot name="prependSlot">
                                    <div class="input-group-text bg-dark">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-date>
                        </div>

                        <div class="col-md-6">
                            <x-adminlte-select2 name="jenis_kelamin" label="Jenis Kelamin" igroup-size="sm"
                                data-placeholder="Pilih jenis kelamin..." required>
                                <x-slot name="prependSlot">
                                    <div class="input-group-text">
                                        <i class="fas fa-venus-mars"></i>
                                    </div>
                                </x-slot>
                                <option />
                                <option value="m">Laki-laki</option>
                                <option value="f">Perempuan</option>
                            </x-adminlte-select2>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="student-modal-footer">-</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
<script src="{{mix('js/master_data/index.js')}}"></script>
@stop