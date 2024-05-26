<?php
include 'header.php';
?>
    <script>
        buttonPengguna = document.getElementById("buttonPengguna");
        buttonPengguna.setAttribute("aria-expanded", "true");
        subButtonPengguna = document.getElementById("sidebar-pengguna");
        subButtonPengguna.classList.add("show");
        buttonPengguna2 = document.getElementById("buttonAddPengguna");
        buttonPengguna2.classList.add("active");
    </script>
    <?php
        $errors = session()->getFlashdata();
        if (isset($errors["errors"])){?>
            <div style="padding-bottom: 0px" class="alert alert-bottom alert-danger alert-dismissible fade show " role="alert">
                <div>Terjadi kesalahan saat menambahkan data:
                    <ul>
                        <?php
                        foreach ($errors as $error){
                            foreach ($error as $err){
                        ?>
                            <li><?=$err?></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        }
        ?>
    <div class="card">
        <div class="card-header d-flex justify-content-between" style="align-items: center">
            <div class="header-title">
                <h4 class="card-title">Tambah Penyelenggara</h4>
            </div>

        </div>
        <div class="card-body">
            <form method="post" action="/admin/penyelenggara/add" enctype="multipart/form-data">
                <div class="row" style="padding-left: 10px;padding-right: 10px">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="validationDefault01">Email</label>
                        <input name="email" autocomplete="off" type="text" class="form-control" id="validationDefault01" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="validationDefault02">Nama Lembaga</label>
                        <input name="namaLembaga" autocomplete="off" type="text" class="form-control" id="validationDefault02" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="validationCustomUsername" class="form-label">Username</label>
                        <input name="username" autocomplete="off" type="text" class="form-control" id="validationCustomUsername" aria-label="Username" aria-describedby="basic-addon1" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="validationDefault03">Alamat Lembaga</label>
                        <input  name="alamatLembaga" autocomplete="off" type="text" class="form-control" id="validationDefault03" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="validationDefault04">Password</label>
                        <input name="password" autocomplete="off" type="password" class="form-control" id="exampleInputPassword3">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="validationDefault05">No Telepon</label>
                        <input name="noTelp" autocomplete="off" type="text" class="form-control" id="validationDefault05" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="validationDefault05">Profile Picture</label>
<!--                        <div id="containerKu" style="max-height: 400px;max-width: 400px">-->
<!--                            <img  id="image" src="">-->
<!--                        </div>-->
                        <input style="display: none;visibility: hidden" name="profilePict" id="uploadGambar" class="form-control" type="file"  accept=".jpg, .jpeg, .png" >
                        <button style=" padding: 0;margin: 0;width: fit-content;height: fit-content" class="form-control" type="button" onclick="klikInput()">
                            <img  id="imageAfter" style="border-radius: 0.25rem;width: 100%;height: 100%; padding: 0px" src="<?=base_url()."/img/add-image.png"?>">
                        </button>



                        <div class="d-inline-block align-items-center" style="font-size: 14px;margin-top: 0px">
                            <span>* Only</span>
                            <a href="javascript:void();">.jpg</a>
                            <a href="javascript:void();">.png</a>
                            <a href="javascript:void();">.jpeg</a>
                            <span>allowed.</span>
                        </div>
                        <br>
                        <div style="font-size: 14px;" class="d-inline-block align-items-center">
                            <span>* If not change, it will use default profile picture.</span>
                        </div>

                    </div>
                </div>
                <button style="margin-left: 10px; margin-top: 10px" class="btn btn-primary " type="submit">Submit</button>
            </form>
        </div>
    </div>
    <script src="<?=base_url()?>customJS/modalProfilePict.js" defer></script>
<?php
include 'footer.php';
?>