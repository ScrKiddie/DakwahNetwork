<?php include 'header.php';?>
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
if (isset($success["success"])){?>
    <div class="mb-3 alert alert-bottom alert-success alert-dismissible fade show" role="alert">
        <span>Berhasil <?=$success["success"]?> data penyelenggara!</span>
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
                    <!--                    <a href="/admin/penyelenggara/new" class="text-center btn btn-primary mt-lg-0 mt-md-0 mt-3" style="margin-top: 0px !important; padding: 3px 15px 3px 5px;display: flex;justify-content: center;align-items: center">-->
                    <!--                        <i class="btn-inner">-->
                    <!--                            <svg style="margin-top: 3px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">-->
                    <!--                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>-->
                    <!--                            </svg>-->
                    <!--                        </i>-->
                    <!--                        <span>Tambah</span>-->
                    <!--                    </a>-->
                </div>
                <div class="card-body">
                    <div class="table-responsive  my-3">
                        <table id="datatable" class="table table-striped dataTable" data-toggle="data-table" aria-describedby="datatable_info">
                            <thead>
                            <tr>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 176.65px;">Judul</th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 278.475px;">Tema</th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 45.475px;">Waktu Mulai</th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 113.5px;">Durasi</th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 106.675px;">Pendakwah</th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 106.675px;">Deskripsi</th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 106.675px;">Lokasi</th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 106.675px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($data as $value):
                                ?>
                                <tr>
                                    <td><?=esc($value['judul'])?></td>
                                    <td><?=esc($value['tema'])?></td>
                                    <td><?=esc($value['waktuMulai'])?></td>
                                    <td><?=esc($value['durasi'])?></td>
                                    <td><?=esc($value['pendakwah'])?></td>
                                    <td><?=esc($value['deskripsi'])?></td>
                                    <td><?=esc($value['lokasi'])?></td>
                                    <td>
                                        <div style="center">
                                            <a class="btn btn-sm btn-icon text-primary flex-end" data-bs-toggle="tooltip" href="/admin/dakwah/edit?id=<?=$value['id']?>" aria-label="Edit Dakwah" >
                                        <span class="btn-inner">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.4925 2.78906H7.75349C4.67849 2.78906 2.75049 4.96606 2.75049 8.04806V16.3621C2.75049 19.4441 4.66949 21.6211 7.75349 21.6211H16.5775C19.6625 21.6211 21.5815 19.4441 21.5815 16.3621V12.3341" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.82812 10.921L16.3011 3.44799C17.2321 2.51799 18.7411 2.51799 19.6721 3.44799L20.8891 4.66499C21.8201 5.59599 21.8201 7.10599 20.8891 8.03599L13.3801 15.545C12.9731 15.952 12.4211 16.181 11.8451 16.181H8.09912L8.19312 12.401C8.20712 11.845 8.43412 11.315 8.82812 10.921Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M15.1655 4.60254L19.7315 9.16854" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                            </a>
                                            <button id="deleteCRUD" class="btn btn-sm btn-icon text-danger" onclick="deleteButton(<?=$value['id']?>,'/admin/dakwah/delete')" aria-label="Delete User" data-bs-original-title="Delete User">
                                        <span class="btn-inner">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="currentColor">
                                                <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                <path d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
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
    <script src="<?=base_url()?>customJS/deleteButton.js" defer></script>
<?php include 'footer.php';?>