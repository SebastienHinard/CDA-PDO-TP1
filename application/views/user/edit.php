<div class="row justify-content-center">
    <form action="" method="post" class="col-md-6 col-lg-4 mt-5">
        <div class="form-group my-1">
            <label for="lastname">Nom</label>
            <input type="text" id="lastname" name="lastname" class="form-control" value="<?= $user->lastname ?? '' ?>">
        </div>
        <div class="form-group my-1">
            <label for="firstname">Prénom</label>
            <input type="text" id="firstname" name="firstname" class="form-control" value="<?= $user->firstname ?? '' ?>">
        </div>
        <div class="form-group my-1">
            <label for="birthdate">Date de naissance</label>
            <input type="date" id="birthdate" name="birthdate" class="form-control" value="<?= $user->birthdate ?? '' ?>">
        </div>
        <div class="form-group my-1">
            <label for="address">Adresse</label>
            <input type="text" id="address" name="address" class="form-control" value="<?= $user->address ?? '' ?>">
        </div>
        <div class="form-group my-1">
            <label for="zipcode">Code Postal</label>
            <input type="text" id="zipcode" name="zipcode" class="form-control" value="<?= $user->zipcode ?? '' ?>">
        </div>
        <div class="form-group my-1">
            <label for="phone">Telephone</label>
            <input type="text" id="phone" name="phone" class="form-control" value="<?= $user->phone ?? '' ?>">
        </div>
        <div class="form-group my-1">
            <label for="id_Services">Service</label>
            <select name="id_Services" class="form-control">
                <option value="0" selected disabled>Veuillez choisir un service</option>
                <?php foreach ($services as $service): ?>
                    <option value="<?= $service->id ?>" <?= $user->id_Services == $service->id ? 'selected' : '' ?>><?= $service->id ?>. <?= $service->name ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row justify-content-around my-5">
            <a href="<?= site_url() ?>" class="btn btn-outline-secondary col-4">Retour</a>
            <input type="submit" class="form-control btn btn-outline-success col-4">
        </div>
    </form>
</div>