<?php require('partials/head.php') ?>
<?php if ($_SESSION['user'] ?? false) : ?>
<?php require('partials/sidebar.php') ?>
<?php require('partials/nav.php') ?>


<main>

    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <h1>Dashboard</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table table-responsive-xl">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Sender</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="alert" role="alert">
                                    <td>
                                        <label class="checkbox-wrap checkbox-primary">
                                            <input type="checkbox" checked="">
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <div class="img" style="background-image: url(images/person_1.jpg);"></div>
                                        <div class="pl-3 email">
                                            <span>markotto@email.com</span>
    
                                        </div>
                                    </td>
                                    <td>Markotto89</td>
                                    <td class="status"><span class="active">Active</span></td>
                                    <td>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="alert" role="alert">
                                    <td>
                                        <label class="checkbox-wrap checkbox-primary">
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <div class="img" style="background-image: url(images/person_2.jpg);"></div>
                                        <div class="pl-3 email">
                                            <span>jacobthornton@email.com</span>
                                            <span>Added: 01/03/2020</span>
                                        </div>
                                    </td>
                                    <td>Jacobthornton</td>
                                    <td class="status"><span class="waiting">Waiting for Resassignment</span></td>
                                    <td>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="alert" role="alert">
                                    <td>
                                        <label class="checkbox-wrap checkbox-primary">
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <div class="img" style="background-image: url(images/person_3.jpg);"></div>
                                        <div class="pl-3 email">
                                            <span>larrybird@email.com</span>
                                            <span>Added: 01/03/2020</span>
                                        </div>
                                    </td>
                                    <td>Larry_bird</td>
                                    <td class="status"><span class="active">Active</span></td>
                                    <td>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="alert" role="alert">
                                    <td>
                                        <label class="checkbox-wrap checkbox-primary">
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td class="d-flex align-items-center">
                                        <div class="img" style="background-image: url(images/person_4.jpg);"></div>
                                        <div class="pl-3 email">
                                            <span>johndoe@email.com</span>
                                            <span>Added: 01/03/2020</span>
                                        </div>
                                    </td>
                                    <td>Johndoe1990</td>
                                    <td class="status"><span class="active">Active</span></td>
                                    <td>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="alert" role="alert">
                                    <td class="border-bottom-0">
                                        <label class="checkbox-wrap checkbox-primary">
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>
                                    <td class="d-flex align-items-center border-bottom-0">
                                        <div class="img" style="background-image: url(images/person_1.jpg);"></div>
                                        <div class="pl-3 email">
                                            <span>garybird@email.com</span>
                                            <span>Added: 01/03/2020</span>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">Garybird_2020</td>
                                    <td class="status border-bottom-0"><span class="waiting">Waiting for Resassignment</span></td>
                                    <td class="border-bottom-0">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
</main>


<?php require('partials/footer.php') ?>
<?php else : require base_path('views/session/create.view.php') ?>
      
<?php endif ?>