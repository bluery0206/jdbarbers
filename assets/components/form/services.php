<form class="uk-form-stacked" action="<?= $action ?>" method="POST">
    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-name-<?= $service->id ?? "" ?>">name</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="form-stacked-name-<?= $service->id ?? "" ?>" type="text" 
                name="name" id="name" value="<?= $service->name ?? "" ?>">
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-description-<?= $service->id ?? "" ?>">description</label>
        <div class="uk-form-controls">
            <textarea class="uk-input" id="form-stacked-description-<?= $service->id ?? "" ?>" name="description"
                id="description"><?= $service->description ?? "" ?></textarea>
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-price-<?= $service->id ?? "" ?>">Price (&#8369;)</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="form-stacked-price-<?= $service->id ?? "" ?>" type="number" step="0.01"
                min="0" name="price" id="price" value="<?= $service->price ?? "" ?>">
        </div>
    </div>
    <div class="uk-margin">
        <input class="uk-button uk-button-primary uk-width-1" type="submit" name="appoint-<?= $day_count?>" value="Confirm">
    </div>
</form>
