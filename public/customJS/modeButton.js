document.addEventListener('DOMContentLoaded', function() {
    var body = document.querySelector('body');
    var kuda = document.getElementById('kuda');
    var cssAneh = document.getElementById("classAneh");

    var darkMode = localStorage.getItem('dark-mode');
    if (darkMode === 'true') {
        cssAneh.innerHTML = `.page-link, select[name="datatable_length"],
        a.page-link[data-dt-idx="previous"],
        a.page-link[data-dt-idx="next"],.form-select {
            border-color: #30384f !important;
        }select[name="datatable_length"]:focus,
a.page-link[data-dt-idx="previous"]:focus,
a.page-link[data-dt-idx="next"]:focus,.form-select:focus {
    border-color: #899af1 !important;
}.swal2-success-circular-line-right,
.swal2-success-fix,
.swal2-success-circular-line-left {
    background-color: #30384f  !important;
}
        `;
        body.classList.add('dark');
        kuda.style.backgroundColor = "#3558e7";
        kuda.innerHTML=`<svg style="margin-left: 0.3px;margin-top: 0.4px"  width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path fill="white" d="M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8M12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18M20,8.69V4H15.31L12,0.69L8.69,4H4V8.69L0.69,12L4,15.31V20H8.69L12,23.31L15.31,20H20V15.31L23.31,12L20,8.69Z"></path>
        </svg>`;


    } else {
        body.classList.add('light');
        cssAneh.innerHTML = "";
        kuda.style.backgroundColor = '#3558e7';
            kuda.innerHTML=`<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path style="fill:#ffffff" d="M17.39 15.14A7.33 7.33 0 0 1 11.75 1.6c.23-.11.56-.23.79-.34a8.19 8.19 0 0 0-5.41.45 9 9 0 1 0 7 16.58 8.42 8.42 0 0 0 4.29-3.84 5.3 5.3 0 0 1-1.03.69z"/></svg>`;
    }
    kuda.addEventListener('click', function() {
        if (body.classList.contains('light')) {
            cssAneh.innerHTML = ` select[name="datatable_length"],
        a.page-link[data-dt-idx="previous"],
        a.page-link[data-dt-idx="next"],.form-select {
            border-color: #30384f !important;
        }select[name="datatable_length"]:focus,
a.page-link[data-dt-idx="previous"]:focus,
a.page-link[data-dt-idx="next"]:focus,.form-select:focus {
    border-color: #899af1 !important;
}.swal2-success-circular-line-right,
.swal2-success-fix,
.swal2-success-circular-line-left {
    background-color: #30384f  !important;
}
        `;
            body.classList.replace('light', 'dark');
            localStorage.setItem('dark-mode', 'true');
            kuda.style.backgroundColor = "#3558e7";
            kuda.innerHTML=`<svg style="margin-left: 0.3px;margin-top: 0.4px"  width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path fill="white" d="M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8M12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18M20,8.69V4H15.31L12,0.69L8.69,4H4V8.69L0.69,12L4,15.31V20H8.69L12,23.31L15.31,20H20V15.31L23.31,12L20,8.69Z"></path>
        </svg>`;
        } else {
            cssAneh.innerHTML = "";
            body.classList.replace('dark', 'light');
            localStorage.setItem('dark-mode', 'false');
            kuda.style.backgroundColor = '#3558e7';
            kuda.innerHTML=`<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path style="fill:#ffffff" d="M17.39 15.14A7.33 7.33 0 0 1 11.75 1.6c.23-.11.56-.23.79-.34a8.19 8.19 0 0 0-5.41.45 9 9 0 1 0 7 16.58 8.42 8.42 0 0 0 4.29-3.84 5.3 5.3 0 0 1-1.03.69z"/></svg>`;
            
        }
    });
});
