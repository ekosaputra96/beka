export function showSuccessMessage(res) {
    return Swal.fire({
        icon: "success",
        title: res.data.title,
        text: res.data.message,
        showConfirmButton: false,
        timer: 1500,
    });
}

export function showErrorMessage(xhr) {
    if (xhr.response.status == 0) return;

    let message =
        xhr.response.data.message ||
        "Something Wrong, refresh page (F5) and try again";

    if (xhr.response.status === 422 && xhr.response.data.errors) {
        const errors = xhr.response.data.errors.valueOf();
        message = Object.values(errors).toString();
    }

    return Swal.fire({
        icon: "error",
        title: "Gagal",
        text: message,
    });
}

export function refreshTable(table) {
    table.DataTable().ajax.reload(null, false);
}
