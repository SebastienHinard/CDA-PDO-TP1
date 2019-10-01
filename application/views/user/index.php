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
                <td><?= $user->id_Services ?></td>
                <td>Edit</td>
                <td>Delete</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>
