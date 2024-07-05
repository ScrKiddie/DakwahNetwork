<?php include 'header.php'; ?>
    <script>
        buttonPengguna = document.getElementById("buttonDakwah");
        buttonPengguna.setAttribute("aria-expanded", "true");
        subButtonPengguna = document.getElementById("sidebar-dakwah");
        subButtonPengguna.classList.add("show");
        buttonPengguna2 = document.getElementById("buttonHistoriDakwah");
        buttonPengguna2.classList.add("active");
    </script>
<?php
$success = session()->getFlashdata();
if (isset($success["success"])) {
    ?>
    <div class="mb-3 alert alert-bottom alert-success alert-dismissible fade show" role="alert">
        <span>Berhasil <?= $success["success"] ?> data penyelenggara!</span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
}
?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between" style="align-items: center">
                    <div class="header-title">
                        <h4 class="card-title">Histori Dakwah</h4>
                    </div>
                    <a href="#" id="excel" class="text-center btn btn-primary mt-lg-0 mt-md-0 mt-3"
                       style="margin-top: 0px !important; padding: 3px 8px 3px 5px;display: flex;justify-content: center;align-items: center">
                        <i class="btn-inner">
                            <svg class="icon-3" width="3" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M12.1535 16.64L14.995 13.77C15.2822 13.47 15.2822 13 14.9851 12.71C14.698 12.42 14.2327 12.42 13.9455 12.71L12.3713 14.31V9.49C12.3713 9.07 12.0446 8.74 11.6386 8.74C11.2327 8.74 10.896 9.07 10.896 9.49V14.31L9.32178 12.71C9.03465 12.42 8.56931 12.42 8.28218 12.71C7.99505 13 7.99505 13.47 8.28218 13.77L11.1139 16.64C11.1832 16.71 11.2624 16.76 11.3515 16.8C11.4406 16.84 11.5396 16.86 11.6386 16.86C11.7376 16.86 11.8267 16.84 11.9158 16.8C12.005 16.76 12.0842 16.71 12.1535 16.64ZM19.3282 9.02561C19.5609 9.02292 19.8143 9.02 20.0446 9.02C20.302 9.02 20.5 9.22 20.5 9.47V17.51C20.5 19.99 18.5 22 16.0446 22H8.17327C5.58911 22 3.5 19.89 3.5 17.29V6.51C3.5 4.03 5.4901 2 7.96535 2H13.2525C13.5 2 13.7079 2.21 13.7079 2.46V5.68C13.7079 7.51 15.1931 9.01 17.0149 9.02C17.4333 9.02 17.8077 9.02318 18.1346 9.02595C18.3878 9.02809 18.6125 9.03 18.8069 9.03C18.9479 9.03 19.1306 9.02789 19.3282 9.02561ZM19.6045 7.5661C18.7916 7.5691 17.8322 7.5661 17.1421 7.5591C16.047 7.5591 15.145 6.6481 15.145 5.5421V2.9061C15.145 2.4751 15.6629 2.2611 15.9579 2.5721C16.7203 3.37199 17.8873 4.5978 18.8738 5.63395C19.2735 6.05379 19.6436 6.44249 19.945 6.7591C20.2342 7.0621 20.0223 7.5651 19.6045 7.5661Z"
                                      fill="currentColor"></path>
                            </svg>
                        </i>
                        <span style="margin-left: 3px">Unduh Excel</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive  my-3">
                        <table id="datatable" class="table table-striped dataTable" data-toggle="data-table"
                               aria-describedby="datatable_info">
                            <thead>
                            <tr>

                                <th class="sorting" tabindex="1" aria-controls="datatable" rowspan="1" colspan="1"
                                    style="width: 278.475px;">Judul
                                </th>
                                <th class="sorting" tabindex="2" aria-controls="datatable" rowspan="1" colspan="1"
                                    style="width: 45.475px;">Tema
                                </th>
                                <th class="sorting" tabindex="3" aria-controls="datatable" rowspan="1" colspan="1"
                                    style="width: 113.5px;">Pendakwah
                                </th>
                                <th class="sorting" tabindex="4" aria-controls="datatable" rowspan="1" colspan="1"
                                    style="width: 106.675px;">Lokasi
                                </th>
                                <th class="sorting" tabindex="5" aria-controls="datatable" rowspan="1" colspan="1"
                                    style="width: 106.675px;">Waktu Mulai
                                </th>

                                <th class="sorting" tabindex="6" aria-controls="datatable" rowspan="1" colspan="1"
                                    style="width: 106.675px;">Durasi
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1"
                                    aria-label="Salary: activate to sort column ascending" style="width: 106.675px;">
                                    Deskripsi
                                </th>
                                <th class="sorting" tabindex="7" aria-controls="datatable" style="width: 176.65px;">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $count = 0;
                            foreach ($data as $value):
                                $count++;
                                ?>
                                <tr>

                                    <td><?= esc($value['judul']) ?></td>
                                    <td><?= esc($value['tema']) ?></td>
                                    <td><?= esc($value['pendakwah']) ?></td>
                                    <td><?= esc($value['lokasi']) ?></td>
                                    <td><?= esc($value['waktuMulai']) ?></td>
                                    <td><?= esc($value['durasi']) ?></td>
                                    <td>
                                        <p style="width: 25rem;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp:4;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
            text-align: justify;
            margin-bottom: 7px;" id="selengkapnyake<?= $count ?>"><?= esc($value['deskripsi']) ?></p>
                                        <?php
                                        if (strlen($value['deskripsi']) > 151) {
                                            ?>
                                            <button id="lengkap"
                                                    onclick="selengkapnyaButton('selengkapnyake<?= $count ?>','lengkap<?= $count ?>')"
                                                    class="btn btn-outline-primary"
                                                    style="width: 25%;height: 25px;font-size: 75%;padding: 0px">
                                                <span id="lengkap<?= $count ?>">Selengkapnya</span>
                                            </button>
                                            <?php
                                        }
                                        ?>
                                    <td>
                                        <div style="center">

                                            <button id="deleteCRUD" class="btn btn-sm btn-icon text-danger"
                                                    onclick="deleteButton(<?= $value['id'] ?>,'/user/dakwah/delete')"
                                                    aria-label="Delete User" data-bs-original-title="Delete User">
                                        <span class="btn-inner">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                      stroke-linejoin="round"></path>
                                                <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5"
                                                      stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                      stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script defer src="<?= base_url() ?>assets/js/xlsx.min.js"></script>
    <script defer src="<?= base_url() ?>customJS/deleteButton.js"></script>
    <script defer>
        function downloadExcel() {
            var table = document.getElementById("datatable").cloneNode(true);
            for (var i = 0; i < table.rows.length; i++) {
                table.rows[i].deleteCell(-1);
            }
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.table_to_sheet(table);
            XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
            XLSX.writeFile(wb, "datatable.xlsx");
        }

        document.getElementById("excel").addEventListener("click", downloadExcel);
    </script>
<?php include 'footer.php'; ?>