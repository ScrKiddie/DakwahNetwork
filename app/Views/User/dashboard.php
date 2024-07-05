<?php
include 'header.php';
?>
<script>
    buttonDashboard = document.getElementById('buttonDashboard');
    buttonDashboard.classList.add("active");
</script>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="row row-cols-1">
            <div class="overflow-hidden d-slider1 ">
                <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                    <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                        <div class="card-body">
                            <div class="progress-widget">
                                <div id="circle-progress-09" class="text-center circle-progress-01 circle-progress circle-progress-warning" data-min-value="0" data-max-value="1000" data-value="150" data-type="percent">
                                    <svg class="card-slie-arrow icon-24 " width="24" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                    </svg>
                                </div>
                                <div class="progress-detail">
                                    <p  class="mb-2">Dakwah</p>
                                    <h4 class="counter"><?=$this->data[0]?></h4>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="1300">
                        <div class="card-body">
                            <div class="progress-widget">
                                <div id="circle-progress-08" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="1000" data-value="150" data-type="percent">
                                    <svg class="card-slie-arrow icon-24 " width="24" viewBox="0 0 24 24">
                                        <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                    </svg>
                                </div>
                                <div class="progress-detail">
                                    <p  class="mb-2">Rekap</p>
                                    <h4 class="counter"><?=$this->data[1]?></h4>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            <div class="swiper-button swiper-button-next"></div>
        <div class="swiper-button swiper-button-prev"></div>
    </div>
</div>
<?php
include 'footer.php';
?>