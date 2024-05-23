function deleteButton(apa){
    const element = document.querySelector(".card-header");
    const warna = getComputedStyle(element).backgroundColor;
    Swal.fire({
        title: `<h4 class="card-title">Apakah kamu yakin?</h4>`,
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        allowOutsideClick:false,
        confirmButtonColor: "#3a57e8",
        cancelButtonColor: "#be3221",
        confirmButtonText: "Yes, delete it!",
        didOpen: () => {
            const popup = Swal.getPopup();
            popup.style.backgroundColor = warna;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData();
            formData.append('id', apa);

            fetch('/admin/penyelenggara/delete', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (response.ok) {
                        Swal.fire({
                            allowOutsideClick:false,
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success",
                            confirmButtonColor: "#3a57e8",
                            didOpen: () => {
                                const popup = Swal.getPopup();
                                popup.style.backgroundColor = warna;
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }}
                        )
                        ;
                    }else if (response.status==409){
                        Swal.fire({
                            title: "Error!",
                            text: "Pengelola ini masih memiliki kajian aktif!",
                            icon: "error",
                            confirmButtonColor: "#3a57e8",
                            didOpen: () => {
                                const popup = Swal.getPopup();
                                popup.style.backgroundColor = warna;
                            }
                        });
                    }
                    else {
                        throw new Error('Failed to delete the item.');
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: "Error!",
                        text: "Failed to delete the item.",
                        icon: "error",
                        confirmButtonColor: "#3a57e8",
                        didOpen: () => {
                            const popup = Swal.getPopup();
                            popup.style.backgroundColor = warna;
                        }
                    });
                });
        }
    });
}
