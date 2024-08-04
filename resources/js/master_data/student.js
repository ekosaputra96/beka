const utils = require("../utils");

let table = $("#student-table");
let studentId = null;
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
                defaultContent: "-",
            },
            {
                data: "tanggal_lahir",
                name: "tanggal_lahir",
                searchable: false,
                defaultContent: "-",
                render: function (data) {
                    return moment(data).format("DD/MM/YYYY");
                },
            },
            {
                data: "nis",
                name: "nis",
                defaultContent: "-",
            },
            {
                data: "jenis_kelamin",
                name: "jenis_kelamin",
                defaultContent: "-",
                render: function (data) {
                    return data == "m" ? "Laki-laki" : "Perempuan";
                },
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
            : route("students.update", studentId);
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
            studentForm.find("select").trigger("change");
            utils.refreshTable(table);
            studentModal.modal("hide");
            return utils.showSuccessMessage(res);
        })
        .catch(function (xhr) {
            return utils.showErrorMessage(xhr);
        })
        .finally(function () {
            studentModalFooter.prop("disabled", false).html(footerText);
        });
});

// edit student
$(document).on("click", ".edit-student", function (e) {
    e.preventDefault();
    studentId = $(this).data("id");
    Swal.showLoading();
    axios
        .get(
            route("students.edit", {
                id: studentId,
            })
        )
        .then(function ({ data: result }) {
            Swal.close();
            studentModalLabel.text(`Edit Siswa : ${result.data.nama}`);
            studentModalFooter.text("Update");
            studentModal.data("mode", "edit");

            // set values
            studentForm.find("input[name=nama]").val(result.data.nama);
            studentForm
                .find("input[name=tanggal_lahir]")
                .val(moment(result.data.tanggal_lahir).format("YYYY-MM-DD"));
            studentForm.find("input[name=nis]").val(result.data.nis);
            studentForm
                .find("select[name=jenis_kelamin]")
                .val(result.data.jenis_kelamin)
                .trigger("change");
            studentModal.modal("show");
        })
        .catch(function (xhr) {
            return utils.showErrorMessage(xhr);
        });
});

// delete student

$(document).on("click", ".delete-student", function (e) {
    e.preventDefault();
    studentId = $(this).data("id");
    studentName = $(this).data("name");
    Swal.fire({
        title: `Hapus siswa ${studentName} ?`,
        icon: "warning",
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Hapus",
    }).then((result) => {
        if (result.isConfirmed) {
            utils.showLoading();
            axios
                .delete(route("students.destroy", { id: studentId }))
                .then(function (res) {
                    utils.refreshTable(table);
                    return utils.showSuccessMessage(res);
                })
                .catch(function (xhr) {
                    return utils.showErrorMessage(xhr);
                });
        }
    });
});
