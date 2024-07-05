document.getElementById("sendButton").addEventListener("click",()=>{
    Swal.fire({
        allowOutsideClick:false,
        title: `<h4 class="card-title" style="margin-top: 50px">Loading</h4>`,
        text: "Tunggu sebentar memproses request.",
        didOpen: () => {
            const popup = Swal.getPopup();
            Swal.showLoading()
        }
    });
    const form = document.getElementById('sendForm');
    const formData = new FormData(form);

    fetch('/contact/send', {
        method: 'POST',
        body: formData
    })
        .then(data => {
            if (data.status == 200) {
                Swal.fire({
                    icon: 'success',
                    title: `<h4 class="card-title">Success</h4>`,
                    text: 'Your message has been sent!',
                    confirmButtonText: 'OK',
                    confirmButtonColor: "#3a57e8"
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: `<h4 class="card-title">Error</h4>`,
                    text: data.message || 'Pastikan sudah mengisi form dengan benar.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: "#3a57e8"
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: `<h4 class="card-title">Error</h4>`,
                text: 'Pastikan sudah mengisi form dengan benar.',
                confirmButtonColor: "#3a57e8",
                confirmButtonText: 'OK'
            });
        });
});
