const utils = require("../utils");

let table = $("#student-table");
const studentForm = $("#student-form");
const studentModal = $("#student-modal");
const studentModalLabel = $("#student-modalLabel");
const studentModalFooter = $("#student-modal-footer");

$(document).ready(function () {
    table.DataTable({
        processing: true,
        serverSide: true,
        ajax: route("students.index"),
        pageLength: 10,
        order: [[0, "asc"]],
        searchDelay: 800,
        columns: [
            {
                data: "nama",
                name: "nama",
                defaultContent: '-'
            },
            {
                data: "tanggal_lahir",
                name: "tanggal_lahir",
                searchable: false,
                defaultContent: '-',
                render: function(data){
                    return moment(data).format("DD/MM/YYYY");
                }
            },
            {
                data: "nis",
                name: "nis",
                defaultContent: '-'
        },
            {
                data: "jenis_kelamin",
                name: "jenis_kelamin",
                defaultContent: '-',
                render: function(data){
                    return data == 'm' ? 'Laki-laki' : 'Perempuan';
                }
            },
            {
                data: "aksi",
                searchable: false,
                orderable: false,
            },
        ],
    });
});

$("#create-student").on("click", function () {
    studentModalLabel.text("Tambah Siswa");
    studentModalFooter.text("Simpan");
    studentModal.data("mode", "add");
    studentModal.modal("show");
});

// submit form
studentForm.on("submit", function (e) {
    e.preventDefault();
    const data = $(this).serialize();
    const mode = studentModal.data("mode");
    const url =
        mode === "add"
            ? route("students.store")
            : route("students.update", studentModal.data("id"));
    const method = mode === "add" ? "POST" : "PUT";
    const footerText = mode === "add" ? "Simpan" : "Update";
    studentModalFooter.prop("disabled", true).html("Loading...");

    axios({
        url,
        method,
        data,
    })
        .then(function (res) {
            studentForm[0].reset();
            studentForm.find('select').trigger('change');
            utils.refreshTable(table);
            studentModal.modal('hide');
            return utils.showSuccessMessage(res)
        })
        .catch(function (xhr) {
            return utils.showErrorMessage(xhr)
        })
        .finally(function () {
            studentModalFooter.prop("disabled", false).html(footerText);
        });
});
