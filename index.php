<?php
require_once 'calendar.php';

$month = $_GET['month'] ?? date('n');
$year = $_GET['year'] ?? date('Y');

$calendar = new Calendar();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <title>Generator Kalendarza</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="form__wrapper">
        <form method="GET" action="">
            <label for="month">Wybierz Miesiąc:</label>
            <select name="month" id="month">
                <?php for ($m = 1; $m <= 12; $m++): ?>
                    <option value="<?php echo $m; ?>" <?php echo ($m == $month) ? 'selected' : ''; ?>>
                        <?php echo $m; ?>
                    </option>
                <?php endfor; ?>
            </select>
            <label for="year">Wybierz Rok:</label>
            <select name="year" id="year">
                <?php for ($y = date('Y') - 10; $y <= date('Y') + 10; $y++): ?>
                    <option value="<?php echo $y; ?>" <?php echo ($y == $year) ? 'selected' : ''; ?>>
                        <?php echo $y; ?>
                    </option>
                <?php endfor; ?>
            </select>
            <button class="btn" type="submit">Pokaż Kalendarz</button>
        </form>
    </div>


    <div class="container anton-regular">
        <?php echo $calendar->generateCalendar($month, $year); ?>
    </div>

</body>
</html>