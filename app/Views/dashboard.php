<?= $this->extend("layout") ?>

<?= $this->section("content") ?>

<div class="container">
    <div class="row justify-content-md-center mt-5">
        <div class="col-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Dashboard</a>
                    <div class="d-flex">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="<?php echo base_url('/logout'); ?>">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <h1>Backups</h1>
            <h2>Listing</h2>
            <ul id="file-list" class="list-group"></ul>
        </div>
    </div>
</div>

<?= $this->endSection() ?>