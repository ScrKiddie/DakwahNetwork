<?php
include 'header.php';
?>
    <script>
        buttonProfile = document.getElementById('buttonPassword');
        buttonProfile.classList.add("active");
    </script>
<?php
$success = session()->getFlashdata();
if (isset($success["success"])) {
    ?>
    <div class="mb-3 alert alert-bottom alert-success alert-dismissible fade show" role="alert">
        <span>Berhasil <?= $success["success"] ?> password!</span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
}
?>
<?php
$errors = session()->getFlashdata();
if (isset($errors["errors"])) {
    ?>
    <div style="padding-bottom: 0px" class="alert alert-bottom alert-danger alert-dismissible fade show " role="alert">
        <div>Terjadi kesalahan saat menambahkan data:
            <ul>
                <?php
                foreach ($errors as $error) {
                    foreach ($error as $err) {
                        ?>
                        <li><?= $err ?></li>
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
                <h4 class="card-title">Change Password</h4>
            </div>

        </div>
        <div class="card-body">
            <form method="post" action="/user/password/update" enctype="multipart/form-data">
                <div class="col" style="padding-left: 10px;padding-right: 10px">
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="validationDefault01">Password lama</label>
                        <input name="oldPass" autocomplete="off" type="password" class="form-control"
                               id="validationDefault01">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="validationDefault02">Password baru</label>
                        <input name="newPass" autocomplete="off" type="password" class="form-control"
                               id="validationDefault02">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="validationDefault02">Ulangi password baru</label>
                        <input name="repeatNewPass" autocomplete="off" type="password" class="form-control"
                               id="validationDefault02">
                    </div>
                </div>
                <button style="margin-left: 10px; margin-top: 10px" class="btn btn-primary " type="submit">Submit
                </button>
            </form>
        </div>
    </div>
<?php
include 'footer.php';
?>