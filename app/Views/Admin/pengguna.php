<?php include 'header.php';?>
    <script>
        buttonPengguna = document.getElementById("buttonPengguna");
        buttonPengguna.setAttribute("aria-expanded", "true");
        subButtonPengguna = document.getElementById("sidebar-pengguna");
        subButtonPengguna.classList.add("show");
        buttonPengguna2 = document.getElementById("buttonListPengguna");
        buttonPengguna2.classList.add("active");
    </script>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Pengguna</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive  my-3">
                        <table id="datatable" class="table table-striped dataTable" data-toggle="data-table" aria-describedby="datatable_info">
                            <thead>
                            <tr>
                                <th class="sorting sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 176.65px;">Name</th><th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 278.475px;">Position</th><th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 132.025px;">Office</th><th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 45.475px;">Age</th><th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 113.5px;">Start date</th><th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 106.675px;">Salary</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="even">
                                <td class="sorting_1">Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012/03/29</td>
                                <td>$433,060</td>
                            </tr>
                            <tr class="even">
                                <td class="sorting_1">Cedric Kelly</td>
                                <td>aSenior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012/03/29</td>
                                <td>$433,060</td>
                            </tr>
                            <tr class="even">
                                <td class="sorting_1">Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012/03/29</td>
                                <td>$433,060</td>
                            </tr>
                            <tr class="even">
                                <td class="sorting_1">Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012/03/29</td>
                                <td>$433,060</td>
                            </tr>
                            <tr class="even">
                                <td class="sorting_1">Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td>22</td>
                                <td>2012/03/29</td>
                                <td>$433,060</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php';?>