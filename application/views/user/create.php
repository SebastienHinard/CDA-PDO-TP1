<div class="row justify-content-center">
    <form action="<?= site_url('create') ?>" method="post" class="col-md-6 col-lg-4 mt-5">
        <div class="form-group my-1">
            <label for="lastname">Nom</label> <?= form_error('lastname') ?>
            <input type="text" id="lastname" name="lastname" class="form-control" value="<?= $_POST['lastname'] ?? '' ?>">
        </div>
        <div class="form-group my-1">
            <label for="firstname">Prénom</label> <?= form_error('firstname') ?>
            <input type="text" id="firstname" name="firstname" class="form-control" value="<?= $_POST['firstname'] ?? '' ?>">
        </div>
        <div class="form-group my-1">
            <label for="birthdate">Date de naissance</label> <?= form_error('birthdate') ?>
            <input type="date" id="birthdate" name="birthdate" class="form-control" value="<?= $_POST['birthdate'] ?? '' ?>">
        </div>
        <div class="form-group my-1">
            <label for="address">Adresse</label> <?= form_error('address') ?>
            <input type="text" id="address" name="address" class="form-control" value="<?= $_POST['address'] ?? '' ?>">
        </div>
        <div class="form-group my-1">
            <label for="zipcode">Code Postal</label> <?= form_error('zipcode') ?>
            <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?= $_POST['zipcode'] ?? '' ?>">
        </div>
        <div class="form-group my-1">
            <label for="phone">Telephone</label> <?= form_error('phone') ?>
            <input type="text" id="phone" name="phone" class="form-control" value="<?= $_POST['phone'] ?? '' ?>">
        </div>
        <div class="form-group my-1">
            <label for="id_Services">Service</label>
            <select name="id_Services" class="form-control">
                <option value="0" selected disabled>Veuillez choisir un service</option>
                <?php foreach ($services as $service): ?>
                    <option value="<?= $service->id ?>" <?= $_POST && $_POST['id_Services'] == $service->id ? 'selected' : '' ?>><?= $service->id ?>. <?= $service->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row justify-content-around my-5">
            <a href="<?= site_url() ?>" class="btn btn-secondary col-4">Retour</a>
            <input type="submit" class="form-control btn btn-success col-4" name="update">
        </div>
    </form>
</div>