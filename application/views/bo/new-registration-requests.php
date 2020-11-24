<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Nouvelles requêtes d'inscription</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col">
                        <div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search"
                                    class="form-control form-control-sm" placeholder=""
                                    aria-controls="dataTable"></label></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0"
                            role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1"
                                        colspan="1" aria-sort="ascending"
                                        aria-label="Name: activate to sort column descending" style="width: 226px;">Nom
                                        & prénom
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1"
                                        aria-label="Position: activate to sort column ascending" style="width: 339px;">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">Nom & prénom</th>
                                    <th rowspan="1" colspan="1">Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach($users as $user) { ?>
                                <tr role="row" class="odd">
                                    <td><?= $user->first_name . ' '. $user->last_name ?></td>
                                    <td>

                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#user-detail" onclick="detail(<?= $user->id ?>);">
                                            Voir
                                        </button>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <?php
            echo $this->pagination->create_links();
            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="user-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <p class="lead">
        Chargement...
    </p>
</div>

<script>
    function detail(id) {
        $('#user-detail').empty();
        $('#user-detail').append(`<p class="lead">
        Chargement...
                </p >`);
        $.ajax({
            url: "<?= base_url('user/registration_request_detail') ?>/" + id,
            async: false,
            cache: false,
        }).done(function (res) {
            $('#user-detail').empty();
            $('#user-detail').append(res);
        });
    }
</script>