let cropper;
let namaFileOriginal;
let typeFileOriginal;
const buttonInput = document.getElementById("uploadGambar");
const gambarAfter = document.getElementById("imageAfter");
buttonInput.addEventListener("change", () => {
    const [file] = buttonInput.files;
    if (file && file.type=="image/jpg" || file.type=="image/jpeg" ||file.type=="image/png") {
        if (cropper) {
            cropper.destroy();
        }
        const element = document.querySelector(".card-header");
        const warna = getComputedStyle(element).backgroundColor;

        Swal.fire({
            title: `<h4 class="card-title" >Crop Profile Pict</h4> `,
            allowOutsideClick:false,
            html: `<div id="containerKu" style="max-height: 100%; max-width: 100%">
               <img id="image" style="max-height: 100%; max-width: 100%" src="">
           </div>`,
            showCancelButton: true,
            confirmButtonColor: "#3a57e8",
            cancelButtonColor: "#be3221",
            confirmButtonText: "Crop",
            cancelButtonText: "Cancel",
            didOpen: () => {
                const popup = Swal.getPopup();
                popup.style.backgroundColor = warna;
            }
        })

        const gambarInput = document.getElementById("image");
        gambarInput.src = URL.createObjectURL(file);
        gambarInput.onload = () => {
            cropper = new Cropper(gambarInput, {
                aspectRatio: 1,
                responsive: true,
            });
        };
        namaFileOriginal = file.name
        typeFileOriginal = file.type
        buttonInput.value = "";
    }
    document.getElementsByClassName("swal2-confirm")[0].addEventListener("click", () => {
        if (cropper) {
            const croppedCanvas = cropper.getCroppedCanvas({
                width: 400,
                height: 400,
            });
            croppedCanvas.toBlob((blob) => {
                const file = new File([blob], namaFileOriginal, { type: typeFileOriginal });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                buttonInput.files = dataTransfer.files;
                gambarAfter.src = URL.createObjectURL(file);
            });
        }

    });
});
function klikInput(){
    document.getElementById("uploadGambar").click()
}