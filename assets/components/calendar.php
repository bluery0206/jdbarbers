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

<div class="uk-container uk-overflow-auto uk-margin" id="calendar">
    <div>
        <h2 class="uk-text-center"><?= date('F') ?> <?= date('Y') ?> Calendar</h2>
        <hr class="uk-divider-small">
        <table class="calendar-table">
            <tr>
                <th>Sunday</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
            </tr>

            <?php
                $sql = "SELECT date_close FROM calendar 
                        WHERE 
                            MONTH(date_close) = MONTH(CURRENT_DATE()) AND 
                            YEAR(date_close) = YEAR(CURRENT_DATE())
                            ORDER BY date_close ASC";
                $close_dates = execute($sql)->fetchAll(PDO::FETCH_COLUMN);
                $close_dates = array_map(
                    fn($date_str) => date("j", strtotime($date_str)), 
                    $close_dates
                );

                $days_in_month = date("t");
                $day_count = 1;
            ?>
            
            <caption>RED IS UNAVAILABOL</caption>

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
                            $is_week_day_match = $week_index ==  $week_day;    

                            // REMINDER: Butngan ug custom day index per week ang closed for []
                            // ie 0, 1, 3 would be closed sa dominggo, lunes, ug Miyerkules
                            $is_closed_day = in_array($week_day, [0, 6]) || in_array($day_count, $close_dates);
                        ?>
                        <?php if ($day_count == $current_day) :?>
                            <td class="calendar-day calendar-day-current">
                        <?php elseif ($day_count < $current_day) :?>
                            <td class="calendar-day calendar-day-past"></td>
                        <?php elseif ($is_closed_day) :?>
                            <td class="calendar-day calendar-day-unavailable">
                        <?php elseif ($is_week_day_match) :?>
                            <td class="calendar-day calendar-day-available">
                        <?php else :  ?>
                            <td>
                        <?php endif ?>
                            <!-- To put the number in the cell -->
                            <?php if ($is_week_day_match && $day_count <= $days_in_month) : ?>
                                <!-- To identify if the current day is closing day -->
                                <?php if ($day_count < $current_day || $is_closed_day || in_array($week_day, $close_dates)) : ?>
                                    <?= $day_count ?>
                                <?php else : ?>
                                    <a href="appointment_add.php?date_appointment=<?= $current_year ?>-<?= $current_month ?>-<?= $day_count ?>" class="calendar-day-link">
                                        <div>
                                            <?= $day_count ?>
                                        </div>
                                        <div>
                                            slots available
                                        </div>
                                    </a>
                                <?php endif ?>

                                <!-- Add a day -->
                                <?php $day_count++; ?>
                            <?php endif ?>
                        </td>
                    <?php endforeach ?>
                </tr>
            <?php endwhile ?>
        </table>
    </div>
</div>