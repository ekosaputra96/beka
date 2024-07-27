let table = $("#student-table").DataTable({
    processing: true,
    serverSide: true,
    ajax: route("students.index"),
    pageLength: 10,
    order: [[0, "asc"]],
    columns: [
        {
            data: "nama",
            name: "nama",
        },
        {
            data: "foto",
            name: "foto",
        },
        {
            data: "nis",
            name: "nis",
        },
        {
            data: "jenis_kelamin",
            name: "jenis_kelamin",
        },
        {
            data: "telpon",
            name: "telpon",
        },
        {
            data: "email",
            name: "email",
        },
        {
            data: "aksi",
            searchable: false,
            orderable: false,
        },
    ],
});

const studentModal = $("#student-modal");
const studentModalLabel = $("#student-modalLabel");
const studentModalFooter = $("#student-modal-footer");

$("#create-student").on("click", function () {
    studentModalLabel.text("Tambah Siswa");
    studentModalFooter.text("Save");
    studentModal.modal("show");
});
