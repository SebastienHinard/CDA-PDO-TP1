<?php if ($users) { ?>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de Naissance</th>
                <th>Addresse</th>
                <th>Code Postal</th>
                <th>Telephone</th>
                <th>Service</th>
                <th colspan='2'></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= $user->lastname ?></td>
                    <td><?= $user->firstname ?></td>
                    <td><?= $user->birthdate ?></td>
                    <td><?= $user->address ?></td>
                    <td><?= $user->zipcode ?></td>
                    <td><?= $user->phone ?></td>
                    <td><?= $user->name ?></td>
                    <td><a href="<?= site_url('edit/'.$user->id) ?>" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a></td>
                    <td><button type="button" data-toggle="modal" data-target="#delete<?= $user->id ?>" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php foreach ($users as $user) { ?>
        <div class="modal fade" id="delete<?= $user->id ?>" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content text-center">
                    <h2 class="bg-dark text-white p-2">Attention</h2>
                    <p>Voulez-vous supprimer <b><?= $user->firstname . ' ' . $user->lastname ?></b>?</p>
                    <div class="row justify-content-center">
                        <a href="<?= site_url('delete/'.$user->id) ?>" class="btn btn-outline-danger col-4 my-3">Confirmer</a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>
<div class="row justify-content-end">
    <a href="<?= site_url('create') ?>" class="btn btn-outline-success mr-5">Ajout utilisateurs</a>
</div>
