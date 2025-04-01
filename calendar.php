<?php

class Calendar {
    public function generateCalendar($month, $year) {
        list($isValid, $errorMessage) = $this->validateDate($month,$year);
        
        if(!$isValid) {
            return "<p class='error'>$errorMessage</p>";
        }

        $daysInMonth = $this->getDaysInMonth($month,$year);
        $firstDay = $this->getFirstWeekday($month, $year);
        $monthName = $this->getMonthName($month);
        
        $html = "
            <div class='month__header'>
            <h2 class='month__header--red'>$monthName</h2> 
            <h2 class='month__header--sm'> $year</h2>
            </div>";
        $html .= $this->generateTableHeader();
        $html .= $this->generateDays($firstDay, $daysInMonth);
        $html .= "</table>";
        
        return $html; 
    }

    public function getDaysInMonth($month, $year) {
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        return $daysInMonth;
    }

    public function getFirstWeekday($month, $year) {
        $firstDay = (new DateTime("$year-$month-01"))->format('N');
        return $firstDay;
    }

    public function getMonthName($month) {
        $months = [
            1 => 'Styczeń',
            2 => 'Luty',
            3 => 'Marzec',
            4 => 'Kwiecień',
            5 => 'Maj',
            6 => 'Czerwiec',
            7 => 'Lipiec',
            8 => 'Sierpień',
            9 => 'Wrzesień',
            0 => 'Październik',
            11 => 'Listopad',
            12 => 'Grudzień'
        ];
    
        return isset($months[$month]) ? $months[$month] : '';

    }

    private function generateTableHeader() {
        $header = "<table >";
        $header .= "<tr>";
        $header .= "<th >Pon</th><th >Wt</th>";
        $header .= "<th>Sr</th><th >Czw</th><th>Pt</th><th>Sob</th><th class='bg__red'>Ndz</th>";
        $header .= "</tr><tr>";
        return $header;
    }

    public function generateDays($firstDay, $daysInMonth) {
        $html = '';

        for ($i = 1; $i < $firstDay; $i++) {
            $html .= "<td class='empty'></td>";
        }

        for ($i = 1; $i <= $daysInMonth; $i++) {

            $isSunday = ($firstDay + $i - 1) % 7 == 0;
            $redTextClass = $isSunday ? "class='text__red'" : "";
            
            $html .=  "<td $redTextClass>$i</td>";

            if (($firstDay + $i - 1) % 7 == 0) {
                $html .= "</tr><tr>"; 
            }
            
        }

        while (($firstDay + $daysInMonth) % 7 != 0) {
            $html .= "<td class='empty'></td>";
            $daysInMonth++;
        }

        $html .= "</tr>"; 

        return $html;

    }

    public static function validateDate($month, $year) {
        $month = is_numeric($month) ? (int)$month : false;
        $year = is_numeric($year) ? (int)$year : false;

        if ($month === false || $year === false) {
            return [false, "Please use the provided valid date."];
        }

        if ($month < 1 || $month > 12) {
            return [false, "Invalid month. Please select a month between 1 and 12."];
        }
    
        if ($year < 1900 || $year > 2100) {
            return [false, "Invalid year. Please select a year between 1900 and 2100."];
        }

        return [true, "Valid"];
    }

}