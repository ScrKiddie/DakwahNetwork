<?php include 'header.php'; ?>
    <script>
        buttonPengguna = document.getElementById("buttonDakwah");
        buttonPengguna.setAttribute("aria-expanded", "true");
        subButtonPengguna = document.getElementById("sidebar-dakwah");
        subButtonPengguna.classList.add("show");
        buttonPengguna2 = document.getElementById("buttonListDakwah");
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
                        <h4 class="card-title">Dakwah</h4>
                    </div>
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
            margin-bottom: 7px;" id="selengkapnyake<?= $count ?>">
                                            <?= esc($value['deskripsi']) ?>
                                        </p>
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
                                    </td>
                                    <td>
                                        <div style="center">
                                            <button id="acceptCRUD" class="btn btn-sm btn-icon text-success"
                                                    onclick="doneButton(<?= $value['id'] ?>,'/user/dakwah/done')"
                                                    aria-label="Done Dakwah" data-bs-original-title="Delete User">
                                        <span class="btn-inner">
                                             <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                                  xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M2.75 12C2.75 17.108 6.891 21.25 12 21.25C17.108 21.25 21.25 17.108 21.25 12C21.25 6.892 17.108 2.75 12 2.75C6.891 2.75 2.75 6.892 2.75 12Z"
                                                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                      stroke-linejoin="round"></path>
                                                <path d="M8.52832 10.5576L11.9993 14.0436L15.4703 10.5576"
                                                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                      stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                            </button>
                                            <a class="btn btn-sm btn-icon text-primary flex-end"
                                               data-bs-toggle="tooltip" href="/user/dakwah/edit?id=<?= $value['id'] ?>"
                                               aria-label="Edit Dakwah">
                                        <span class="btn-inner">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341"
                                                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                      stroke-linejoin="round"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                      d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z"
                                                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                      stroke-linejoin="round"></path>
                                                <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor"
                                                      stroke-width="1.5" stroke-linecap="round"
                                                      stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                            </a>
                                            <button id="deleteCRUD" class="btn btn-sm btn-icon text-danger"
                                                    onclick="deleteButton(<?= $value['id'] ?>,'/user/dakwah/delete')"
                                                    aria-label="Delete Dakwah" data-bs-original-title="Delete User">
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
    <script src="<?= base_url() ?>customJS/deleteButton.js" defer></script>
    <script src="<?= base_url() ?>customJS/doneButton.js" defer></script>

<?php include 'footer.php'; ?>