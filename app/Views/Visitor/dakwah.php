<?php include 'header.php'; ?>
<div class="sub-header" style="background-image: url('<?= base_url() ?>img/bg.png');background-size: 330px">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3 class="mb-4 text-white">Dakwah</h3>
                <h6 class="text-white">Semua dakwah yang akan berlangsung.</h6>
            </div>
        </div>
    </div>
</div>
<div class="inner-card-box" style="min-height: 300px">
    <?php
    if (empty($data)) {
        ?>
        <div class="placeholder">
            <div class="loadera"></div>
            <p style="margin-top: 30px;margin-bottom: 0px">Saat ini belum ada kajian yang akan berlangsung.</p>
            <p class="keduax" style="margin-top: 0px">Konten akan muncul di sini jika ada kajian yang akan
                berlangsung.</p>
        </div>
        <?php
    } else {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="input-group mb-3">
                        <input type="text" id="searchInput" class="form-control"
                               placeholder="Cari berdasarkan judul...">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary customme2" type="button" onclick="searchByTitle()">
                                Cari
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" id="cards-container">

            </div>
            <div id="pagination-buttons" class="text-center mt-3">
            </div>
        </div>
    <?php } ?>

</div>
<script defer src="<?= base_url() ?>customJS/getPenyelenggaraById.js"></script>
<script defer>
    var data = <?= json_encode(esc($data)) ?>;
    var totalCards = <?= count($data) ?>;
    var cardsPerPage = 3;
    var maxButtons = 3;
    var totalPages = Math.ceil(totalCards / cardsPerPage);

    function renderCards(pageNumber, searchData) {
        var filteredData = searchData ? searchData : data;
        var startIndex = (pageNumber - 1) * cardsPerPage;
        var endIndex = Math.min(startIndex + cardsPerPage, filteredData.length);
        var cardsContainer = document.getElementById('cards-container');
        cardsContainer.innerHTML = '';

        for (var i = startIndex; i < endIndex; i++) {
            var value = filteredData[i];
            var cardDiv = document.createElement('div');
            cardDiv.id = 'card-' + i;
            cardDiv.className = 'col-lg-4 col-md-6 mx-auto ';
            cardDiv.style.display = 'none';
            cardDiv.style.visibility = 'hidden';

            var cardContent = `
                <div class="card" style="margin-right: auto; margin-left: auto;">
                    <div class="card-body p-3">
                        <img src="<?= base_url() ?>upload/${value.posterPict}" alt="" class="img-fluid rounded" loading="lazy">
                        <p class="text-black pt-3" style="margin-bottom: 10px">${value.waktuMulai}</p>
                        <h5 style="width: 100%; font-size: 25px">${value.judul}</h5>

                        <p style="margin-top: 5px;margin-bottom: 0px"> Lokasi: <span class="text-black"> ${value.lokasi}</span></p>
                        <p style="margin-top: 0px;margin-bottom: 0px"> Durasi: <span class="text-black"> ${value.durasi} Menit</span></p>
                        <p style="margin-top: 0px;margin-bottom: 0px"> Tema: <span class="text-black"> ${value.tema}</span></p>
                        <button onclick="getPenyelenggaraById('<?= base_url() ?>upload/${value.profilePict}','${value.namaLembaga}','${value.noTelp}','${value.email}','${value.alamatLembaga}')" class="btn-as-paragraph" style="margin-top: 0px;margin-bottom: 0px"> Penyelenggara: <span class="text-primary">${value.namaLembaga}</span></button>
                        <p style="margin-top: 0px;margin-bottom: 0px"> Pendakwah: <span class="text-black">${value.pendakwah}</span></p>
                        <p style="margin-top: 0px;margin-bottom: 0px"> Deskripsi:</p>

                        <div style="border: 2px solid #f5f5f5;background-color: #f5f5f5;padding: 5px;border-radius: 5px;height: 120px;overflow-y: scroll;">
                            <p class="text-black" style="text-align: justify; margin-bottom: 5px;">
                                ${value.deskripsi}
                            </p>
                        </div>

                    </div>
                </div>
            `;
            cardDiv.innerHTML = cardContent;
            cardsContainer.appendChild(cardDiv);
            cardDiv.style.display = 'block';
            cardDiv.style.visibility = 'visible';
        }

        createPaginationButtons(pageNumber, filteredData);
    }

    function createPaginationButtons(currentPage, filteredData) {
        var paginationContainer = document.getElementById("pagination-buttons");
        paginationContainer.innerHTML = "";

        var startPage = Math.max(1, currentPage - Math.floor(maxButtons / 2));
        var endPage = Math.min(totalPages, startPage + maxButtons - 1);

        if (endPage - startPage + 1 < maxButtons) {
            startPage = Math.max(1, endPage - maxButtons + 1);
        }

        var prevButton = document.createElement("button");
        prevButton.textContent = "<";
        prevButton.classList.add("btn", "btn-outline-primary", "mr-1", "m-1", "customme");
        prevButton.onclick = function () {
            showPage(currentPage - 1, filteredData);
        };
        paginationContainer.appendChild(prevButton);

        for (var i = startPage; i <= endPage; i++) {
            var button = document.createElement("button");
            button.textContent = i;
            button.classList.add("btn", "btn-outline-primary", "mr-1", "m-1", "customme");
            if (i === currentPage) {
                button.classList.add("active");
            }
            button.onclick = function () {
                showPage(parseInt(this.textContent), filteredData);
            };
            paginationContainer.appendChild(button);
        }

        var nextButton = document.createElement("button");
        nextButton.textContent = ">";
        nextButton.classList.add("btn", "btn-outline-primary", "mr-1", "m-1", "customme");
        nextButton.onclick = function () {
            showPage(currentPage + 1, filteredData);
        };
        paginationContainer.appendChild(nextButton);

        if (currentPage === 1) {
            prevButton.disabled = true;
        }

        if (currentPage === totalPages) {
            nextButton.disabled = true;
        }
    }

    function showPage(pageNumber, searchData) {
        var cardsContainer = document.getElementById('cards-container');
        cardsContainer.innerHTML = '';
        renderCards(pageNumber, searchData);
    }

    function searchByTitle() {
        var searchInput = document.getElementById('searchInput').value.toLowerCase();
        var searchData = data.filter(function (item) {
            return item.judul.toLowerCase().includes(searchInput);
        });
        totalCards = searchData.length;
        totalPages = Math.ceil(totalCards / cardsPerPage);
        showPage(1, searchData);
    }

    renderCards(1, null);
</script>
<?php include 'footer.php'; ?>
