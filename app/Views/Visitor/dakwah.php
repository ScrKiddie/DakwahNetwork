<?php
include 'header.php';
?>
    <div class="sub-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h3 class="mb-4 text-white">Dakwah</h3>
                    <h6 class="text-white">Semua kajian yang akan berlangsung.</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="inner-card-box" style="min-height: 300px" >
        <div class="container" >
            <div class="row" >
                <?php
                if (empty($data)){
                    ?>
                    <div class="placeholder">
                        <div class="loadera"></div>
                        <p style="margin-top: 30px;margin-bottom: 0px">Saat ini belum ada kajian yang akan berlangsung.</p>
                        <p class="keduax" style="margin-top: 0px">Konten akan muncul di sini jika ada kajian yang akan berlangsung.</p>
                    </div>
                    <?php
                }
                ?>
                <?php
                foreach ($data as $value):
                    ?>
                <div class="col-lg-4 col-md-6" style="margin-right: auto; margin-left: auto;" >
                    <div class="card">
                        <div class="card-body p-3">
                            <img src="<?=base_url()."upload/".$value["posterPict"]?>" alt="" class="img-fluid rounded
                        " loading="lazy">
                            <p class="text-primary pt-3" style="margin-bottom: 10px"><?=$value["waktuMulai"]?></p>
                            <h5 style="width: 100%; font-size: 25px" ><?=$value["judul"]?></h5>

                            <p style="margin-top: 5px;margin-bottom: 0px"> Lokasi: <span class="text-primary"> <?=$value["lokasi"]?></span></p>
                            <p style="margin-top: 0px;margin-bottom: 0px"> Durasi: <span class="text-primary"> <?=$value["durasi"]?> Menit</span></p>
                            <p style="margin-top: 0px;margin-bottom: 0px"> Tema: <span class="text-primary"> <?=$value["tema"]?></span></p>
                            <p style="margin-top: 0px;margin-bottom: 0px"> Penyelenggara: <span class="text-primary"><?=$value["nama_penyelenggara"]?></span></p>
                            <p style="margin-top: 0px;margin-bottom: 0px"> Pendakwah: <span class="text-primary"><?=$value["pendakwah"]?></span></p>
                            <p style="margin-top: 0px;margin-bottom: 0px"> Deskripsi:</p>

                            <div style="border: 2px solid #f5f5f5;background-color: #f5f5f5;padding: 5px;border-radius: 5px;height: 120px;overflow-y: scroll;">
                                <p class="text-black" style="text-align: justify; margin-bottom: 5px;">
                                    <?=$value["deskripsi"]?>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<!-- Wrapper-End -->
<!-- Footer-start -->


<?php
include 'footer.php';
?>