function acceptButton(apa){
    const element = document.querySelector(".card-header");
    const warna = getComputedStyle(element).backgroundColor;
    const element2 = document.querySelector(".card-title");
    const warna2 = getComputedStyle(element2).color
    Swal.fire({
        title: `<h4 class="card-title">Apakah kamu yakin?</h4>`,
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        allowOutsideClick:false,
        confirmButtonColor: "#3a57e8",
        cancelButtonColor: "#be3221",
        confirmButtonText: "Yes, accept it!",
        didOpen: () => {
            const popup = Swal.getPopup();
            popup.style.color= warna2;
            popup.style.backgroundColor = warna;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                allowOutsideClick:false,
                title: `<h4 class="card-title">Loading</h4>`,
                text: "Tunggu sebentar memproses request.",
                didOpen: () => {
                    const popup = Swal.getPopup();
                    popup.style.color= warna2;
                    popup.style.backgroundColor = warna;
                    Swal.showLoading()
                }
            });
            const formData = new FormData();
            formData.append('id', apa);

            fetch('/admin/penyelenggara/accept', {
                method: 'POST',
                body: formData
            })
                .then(response => {
                    if (response.ok) {
                        Swal.fire({
                            allowOutsideClick:false,
                            title: "acceptd!",
                            text: "Your item has been accepted.",
                            icon: "success",
                            confirmButtonColor: "#3a57e8",
                            didOpen: () => {
                                const popup = Swal.getPopup();
                                popup.style.color= warna2;
                                popup.style.backgroundColor = warna;
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }}
                        )
                        ;
                    }
                    else {
                        throw new Error('Failed to accept the item.');
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: "Error!",
                        text: "Failed to accept the item.",
                        icon: "error",
                        confirmButtonColor: "#3a57e8",
                        didOpen: () => {
                            const popup = Swal.getPopup();
                            popup.style.color= warna2;
                            popup.style.backgroundColor = warna;
                        }
                    });
                });
        }
    });
}
