<?php
require_once 'check.php';

class Exporter 
{

    private $format;

    private $userId;

    public function __construct($params)
    {
        $this->format = $params['format'];
        $this->userId = $params['user_id'];
    }

    public function generate()
    {
        // open raw memory as file so no temp files needed, you might run out of memory though
        $file = fopen('php://memory', 'w'); 
        $data = $this->getData();

        switch ($this->format) {
        case 'csv':
            $file = $this->writeCSV($file, $data);
            break;
        case 'ics':
            $file = $this->writeICal($file, $data);
            break;
        }

        return $file;
    }

    public function getContentType()
    {
        switch ($this->format) {
        case 'csv':
            return 'application/csv';
            break;
         case 'ics':
            return 'text/calendar';
            break;   

        }
    }

    public function getFilename()
    {
        return 'export.' . $this->format;
    }

    private function getData()
    {
        $db = new Baza();
        $sql = 'SELECT typ_tanca.nazwa, harmonogram.data, harmonogram.godz_start, harmonogram.data 
        as data2, harmonogram.godz_stop 
        FROM harmonogram 
        INNER JOIN typ_tanca ON typ_tanca.id_tanca = harmonogram.id_tanca 
        INNER JOIN zajecia ON zajecia.id_zajec = harmonogram.id_zajec 
        INNER JOIN sala ON sala.id_sala=harmonogram.id_sala 
        WHERE zajecia.id_uzytkownika = :id_uzytkownika';
        $q = $db->prepare($sql);
        $q->bindParam(':id_uzytkownika', $this->userId);
        $q->execute();

        return $q->fetchAll(PDO::FETCH_ASSOC);
    }

    private function writeCSV($file, $data)
    {
        fputs($file, '"Subject","Start Date","Start Time","End Date","End Time"' . PHP_EOL);
        foreach ($data as $line) { 
           foreach ($line as &$column) 
                $column = '"' . $column . '"';
            unset($column);

            fputcsv($file, $line, ',', ' ');
        }

        return $file;
    }

    private function writeICal($file, $data)
    {
        fputs($file, 'BEGIN:VCALENDAR' . PHP_EOL);
        fputs($file, 'VERSION:2.0' . PHP_EOL);
        fputs($file, 'PRODID:-//hacksw/handcal//NONSGML v1.0//EN' . PHP_EOL);

        foreach ($data as $line) { 
            $start = str_replace ('-', '', $line['data']) . 'T' . str_replace (':', '', $line['godz_start']) . 'Z';
            $end = str_replace ('-', '', $line['data']) . 'T' . str_replace (':', '', $line['godz_stop']) . 'Z';
    
            fputs($file, 'BEGIN:VEVENT' . PHP_EOL);
            fputs($file, 'DTSTART:' . $start . PHP_EOL);
            fputs($file, 'DTEND:' . $end . PHP_EOL);
            fputs($file, 'SUMMARY:' . $line['nazwa'] . PHP_EOL);
            fputs($file, 'END:VEVENT' . PHP_EOL); 
        }

        fputs($file, 'END:VCALENDAR' . PHP_EOL);       

        return $file;
    }

}