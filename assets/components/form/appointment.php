<form class="uk-form-stacked" action="<?= $action ?>" method="POST">
    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-name-<?= $day_count ?>">Name</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="form-stacked-name-<?= $day_count ?>" type="text" 
                name="name" id="name" value="<?= $appointment->name ?? "" ?>" placeholder="Juan Dela Cruz" required>
        </div>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-email-<?= $day_count ?>">Email</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="form-stacked-email-<?= $day_count ?>" type="email" 
                name="email" id="email" value="<?= $appointment->email ?? "" ?>" placeholder="jdcruz@something.com" >
        </div>
    </div>

    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-mobile-<?= $day_count ?>">Mobile No.</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="form-stacked-mobile-<?= $day_count ?>" type="text" 
                name="mobile" id="mobile" minlength="0" maxlength="11" 
                value="<?= $appointment->mobile ?? "" ?>" placeholder="09123456789">
        </div>
    </div>
    
    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-service-<?= $day_count ?>">Service</label>
        <div class="uk-form-controls">
            <select name="service_id" class="uk-select" id="form-stacked-service-<?= $day_count ?>" required>
                <?php 
    
                    $sql = "SELECT * FROM services";
                    $jbas_services = execute($sql)->fetchAll();
    
                ?>
                <option value="">Please select...</option>
                <?php foreach ($jbas_services as $jbas_service) : ?>
                    <option value="<?= $jbas_service->id ?>" 
                        <?php if (isset($appointment)) : ?>
                            <?= $appointment->service_id == $jbas_service->id ? "selected" : "" ?>
                        <?php endif ?>
                    >
                        <?= $jbas_service->name ?> (&#8369;<?= $jbas_service->price ?>) - <?= $jbas_service->description ?>
                    </option>
                <?php endforeach?>
            </select>
        </div>
    </div>
    <div class="uk-margin">
        <input class="uk-button uk-button-primary uk-width-1" type="submit" name="appoint-<?= $day_count?>" value="Confirm">
    </div>
</form>