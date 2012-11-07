<?php

class Date {
    
    private $day;
    private $month;
    private $year;
    private $time;
    private $time_zone;
    
    public static $month_array = array(
        "Jan" => 1,
        "January" => 1,
        
        "Feb" => 2,
        "February" => 2,
        
        "Mar" => 3,
        "March" => 3,
        
        "Apr" => 4,
        "April" => 4,
        
        "May" => 5,
        
        "Jun" => 6,
        "June" => 6,
        
        "Jul" => 7,
        "July" => 7,
        
        "Aug" => 8,
        "August" => 8,
        
        "Sep" => 9,
        "September" => 9,
        
        "Oct" => 10,
        "October" => 10,
        
        "Nov" => 11,
        "November" => 11,
        
        "Dec" => 12,
        "Decemeber" => 12
    );
    
    public function __construct($day, $month, $year, $time, $time_zone) {
        $this->day = (int) $day;
        $this->month = $month;
        $this->year = (int) $year;
        $this->time = $time;
        $this->time_zone = $time_zone;
    }
    
    public function get_day() {
        return $this->day;
    }
    
    public function get_month() {
        return $this->month;
    }
    
    public function get_year() {
        return $this->year;
    }
    
    public function get_time() {
        return $this->time;
    }
    
    public function get_time_zone() {
        return $this->time_zone;
    }
    
    private function get_month_int() {
        return self::$month_array[$this->month];
    }
    
    /* Returns -1 if $date1 is more recent than $date2, 
     * 0 if they are the same time, or 1 if $date is more recent.
     */
    public static function compare_dates($date1, $date2) {
        if ($date1->year != $date2->year) {
            if ($date1->year > $date2->year) {
                return -1;
            } else return 1;
        } // Compare Years
        
        if ($date1->get_month_int() != $date2->get_month_int()) {
            if ($date1->get_month_int() > $date2->get_month_int()) {
                return -1;
            } else return 1;
        } // Compare Months
        
        if ($date1->day != $date2->day) {
            if ($date1->day > $date2->day) {
                return -1;
            } else return 1;
        } // Compare Days
        
        $date1_time_array = explode(":",$date1->time);
        $date1_hour = (int) $date1_time_array[0];
        $date1_minute = (int) $date1_time_array[1];
        $date1_second = (int) $date1_time_array[2];
        
        $date2_time_array = explode(":",$date2->time);
        $date2_hour = (int) $date2_time_array[0];
        $date2_minute = (int) $date2_time_array[1];
        $date2_second = (int) $date2_time_array[2];
        
        if ($date1_hour != $date2_hour) {
            if ($date1_hour > $date2_hour) {
                return -1;
            } else return 1;
        } // Compare Hours
        
        if ($date1_minute != $date2_minute) {
            if ($date1_minute > $date2_minute) {
                return -1;
            } else return 1;
        } // Compare Minutes
        
        if ($date1_second != $date2_second) {
            if ($date1_second > $date2_second) {
                return -1;
            } else return 1;
        } // Compare Seconds
        
        return 0; // Equivalent
    }
}

?>
