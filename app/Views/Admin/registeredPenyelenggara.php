<?php include 'header.php';?>
    <script>
        buttonPengguna = document.getElementById("buttonPengguna");
        buttonPengguna.setAttribute("aria-expanded", "true");
        subButtonPengguna = document.getElementById("sidebar-pengguna");
        subButtonPengguna.classList.add("show");
        buttonPengguna2 = document.getElementById("buttonRegisterPengguna");
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
                        <h4 class="card-title">Penyelenggara Pendaftar</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive  my-3">
                        <table id="datatable" class="table table-striped dataTable" data-toggle="data-table" aria-describedby="datatable_info">
                            <thead>
                            <tr>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 176.65px;">Email</th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 278.475px;">Username</th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 45.475px;">Nama Lembaga</th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 113.5px;">Alamat</th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 106.675px;">No Telp</th>
                                <th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 106.675px;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($data as $value):
                                ?>
                                <tr>
                                    <td><?=$value['email']?></td>
                                    <td><?=$value['username']?></td>
                                    <td><?=$value['namaLembaga']?></td>
                                    <td><?=$value['alamatLembaga']?></td>
                                    <td><?=$value['noTelp']?></td>
                                    <td>
                                        <div style="center">
                                            <button id="deleteCRUD" class="btn btn-sm btn-icon text-success" onclick="acceptButton(<?=$value['id']?>)" aria-label="Delete User" data-bs-original-title="Delete User">
                                        <span class="btn-inner">
                                                                            <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                    <path d="M12.0001 8.32739V15.6537" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path d="M15.6668 11.9904H8.3335" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16.6857 2H7.31429C4.04762 2 2 4.31208 2 7.58516V16.4148C2 19.6879 4.0381 22 7.31429 22H16.6857C19.9619 22 22 19.6879 22 16.4148V7.58516C22 4.31208 19.9619 2 16.6857 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                            </svg>
                                        </span>
                                            </button>

                                            <button id="deleteCRUD" class="btn btn-sm btn-icon text-danger" onclick="deleteButton(<?=$value['id']?>)" aria-label="Delete User" data-bs-original-title="Delete User">
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
    <script src="<?=base_url()?>customJS/acceptButton.js" defer></script>
<?php include 'footer.php';?>