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

    $date = filter_input(INPUT_GET, "date", FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? date("Y-m-d");
    // echo "date: "; var_dump($date); echo "<br>";

    $year           = date('Y', strtotime($date));
    $month          = date('m', strtotime($date));
    $days_in_month  = date("t", strtotime("$year-$month-01"));
    $month_name     = date('F', strtotime($date));
    
    $current_date   = date('Y-m-d');
    
    // echo "days_in_month: "; var_dump($days_in_month); echo "<br>";
    // echo "date('Y-m-d', strtotime($date - month)): "; var_dump(date("Y-m-d", strtotime($date." -1 month"))); echo "<br>";
    // echo "year: "; var_dump($year); echo "<br>";
    // echo "month: "; var_dump($month); echo "<br>";
    // echo "month_name: "; var_dump($month_name); echo "<br>";
    // echo "current_date: "; var_dump($current_date); echo "<br>";

    $sql = "SELECT date_close FROM close_dates 
            WHERE 
                MONTH(date_close) = MONTH(?)
            ORDER BY date_close ASC";
    $values = [$date];
    $close_dates = execute($sql, $values)->fetchAll(PDO::FETCH_COLUMN);

?>

<div class="uk-container uk-overflow-auto uk-margin" id="calendar">
    <div>
        <div class="uk-flex uk-flex-between uk-flex-middle">
            <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']."?date=".date("Y-m-d", strtotime($date." -1 month"))."#calendar")?>" class="uk-button uk-button-default">
                Previous Month
            </a>
            <h2 class="uk-text-center"><?= $month_name ?> <?= $year ?> Calendar</h2>
            <a href="<?= htmlspecialchars($_SERVER['PHP_SELF']."?date=".date("Y-m-d", strtotime($date." +1 month"))."#calendar")?>" class="uk-button uk-button-default">
                Next Month
            </a>
        </div>
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
                <?php $day_count = 1; ?>
                <?php while ($day_count <= $days_in_month) : ?>
                    <tr>
                        <!-- 0 represents Sunday ... 6 represents Saturday -->
                        <?php foreach (range(0, 6) as $week_index) : ?>
                            <?php

                                $loop_date = date("Y-m-d", strtotime("$year-$month-$day_count"));
                                $week_day = date("w", strtotime($loop_date));

                                // echo "loop_date: "; var_dump($loop_date); echo "<br>";
                                // echo "week_day: "; var_dump($week_day); echo "<br>";
                                // echo "week_index: "; var_dump($week_index); echo "<br>";
                                // echo "week_index: $week_index = week_day: $week_day = "; var_dump($week_index == $week_day); echo "<br>";

                                $is_week_day_match  = $week_index == $week_day;    
                                $is_closed_day      = in_array($loop_date, $close_dates);
                                $is_current_date    = "$year-$month-$day_count" == $current_date;
                                $is_month           = $is_week_day_match && $day_count <= $days_in_month;
                                $is_in_past         = $is_week_day_match && $loop_date < $current_date && $is_month;

                            ?>

                            <td class="calendar-day
                                <?php if ($is_current_date) :?>
                                    calendar-day-current
                                <?php elseif ($is_closed_day): ?>
                                    calendar-day-unavailable
                                <?php elseif ($is_in_past): ?>
                                    calendar-day-past
                                <?php elseif ($is_month): ?>
                                    calendar-day-available
                                <?php endif ?>
                            ">
                                <div>
                                    <!-- To put the number in the cell -->
                                    <?php if ($is_month) : ?>
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