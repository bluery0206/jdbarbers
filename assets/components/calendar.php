<!-- 
    Calendar Component
    Displays a simple calendar for the current month.

    For future me who'll not understand shit in thisf code.

    Imagine naa tay empty nga calendar table except that we know
    what the current year, date, pila kabuok ang adlaw sa buwan, ug
    unsay ngalan sa adlaw.

    Example: December 1, 2025 is adlaw nga "Monday"

    Then, we fill up every cell with the corresponding day.
    
    Pseudocode:
        Samtang naa pa tay adlaw nga wala nabutang sa calendar, Magbutang.
            Kada adlaw sa usa ka semana, atong tan-awun if ang date is ambot
            tiwason ra ni nako
    -->
<?php 

    $sql = "SELECT date_close FROM close_dates 
            WHERE 
                MONTH(date_close) = MONTH(CURRENT_DATE())
            ORDER BY date_close ASC";
    $close_dates = execute($sql)->fetchAll(PDO::FETCH_COLUMN);

?>

<div class="uk-container uk-overflow-auto uk-margin" id="calendar">
    <div>
        <h2 class="uk-text-center"><?= date('F') ?> <?= date('Y') ?> Calendar</h2>
        <table class="calendar-table">
            <thead>
                <tr>
                    <th>Sunday</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                </tr>
            </thead>

            <tbody>
                <?php

                    $days_in_month = date("t");
                    $day_count = 1;

                ?>
                <?php while ($day_count <= $days_in_month) : ?>
                    <tr>
                        <!-- 0 represents Sunday ... 6 represents Saturday -->
                        <?php foreach (range(0, 6) as $week_index) : ?>
                            <?php

                                $current_year   = date('Y');
                                $current_month  = date('m');
                                $current_day  = date('d');

                                $date = "$current_year-$current_month-$day_count";

                                $week_day = date("w", strtotime($date)); // Retuyrns Monday, Tuesday, ..

                                $is_week_day_match  = $week_index == $week_day;    
                                $is_closed_day      = in_array($date, $close_dates);
                                $is_current_day     = $day_count == $current_day;
                                $is_in_past         = $is_week_day_match && $day_count < $current_day;
                                $is_current_month   = $is_week_day_match && $day_count <= $days_in_month;

                            ?>

                            <td class="calendar-day
                                <?php if ($is_current_day) :?>
                                    calendar-day-current
                                <?php elseif ($is_closed_day): ?>
                                    calendar-day-unavailable
                                <?php elseif ($is_in_past): ?>
                                    calendar-day-past
                                <?php elseif ($is_current_month): ?>
                                    calendar-day-available
                                <?php endif ?>
                            ">
                                <div>
                                    <!-- To put the number in the cell -->
                                    <?php if ($is_current_month) : ?>
                                        <!-- To identify if the current day is closing day -->
                                        <?php if ($is_in_past || $is_closed_day) : ?>
                                            <?= $day_count ?>
                                        <?php else : ?>
                                                <a class="calendar-day-link" href="#modal-container-<?= $day_count?>" uk-toggle>
                                                    <div><?= $day_count ?></div>
                                                    <!-- <div>slots available</div> -->
                                                </a>

                                                <div id="modal-container-<?= $day_count?>" class="uk-modal-container" uk-modal>
                                                    <div class="uk-modal-dialog">
                                                        <button class="uk-modal-close-default" type="button" uk-close=""></button>
                                                        <div class="uk-modal-header">
                                                            <h2 class="uk-modal-title">Set appointment on <?= date("F d, Y, l", strtotime($date))?></h2>
                                                        </div>
                                                        <div class="uk-modal-body">
                                                            <?php 
                                                            
                                                                $action = "appointment_add.php?date_appointment=$date";
                                                            
                                                            ?>
                                                            <?php include "assets/components/form/appointment.php"; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php endif ?>

                                        <!-- Add a day -->
                                        <?php $day_count++; ?>
                                    <?php endif ?>
                                </div>
                            </td>
                        <?php endforeach ?>
                    </tr>
                <?php endwhile ?>
            </tbody>
        </table>
    </div>
</div>