<form class="uk-form-stacked" action="<?= $action ?>" method="POST">
    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-date-<?= $close_date->id ?? "" ?>">Date</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="form-stacked-date-<?= $close_date->id ?? "" ?>" type="date" 
                name="date_close" id="date_close" value="<?= $close_date->date_close ?? "" ?>">
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-time_start-<?= $close_date->id ?? "" ?>">Time Start</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="form-stacked-time_start-<?= $close_date->id ?? "" ?>" type="time" 
                name="time_start" id="time_start" value="<?= $close_date->time_start ?? "" ?>">
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="form-stacked-time_end-<?= $close_date->id ?? "" ?>">Time End</label>
        <div class="uk-form-controls">
            <input class="uk-input" id="form-stacked-time_end-<?= $close_date->id ?? "" ?>" type="time" 
                name="time_end" id="time_end" value="<?= $close_date->time_end ?? "" ?>">
        </div>
    </div>
    <div class="uk-margin">
        <input class="uk-button uk-button-primary uk-width-1" type="submit" name="appoint-<?= $day_count?>" value="Confirm">
    </div>
</form>