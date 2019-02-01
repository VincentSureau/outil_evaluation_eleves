<?php

namespace App\Service;

class Excel2Table
{
    public function convertSheet($uploadedsheet, $sheetname){

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($uploadedsheet);
        $reader->setReadDataOnly(TRUE);
        $reader->setLoadSheetsOnly([$sheetname]);
        $spreadsheet = $reader->load($uploadedsheet);
        $worksheet = $spreadsheet->getActiveSheet();

        $table = [];
        foreach ($worksheet->getRowIterator() as $rowIndex => $row) {
            $studentDatas = [];
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            foreach ($cellIterator as $cellIndex => $cell) {
                if($cellIndex == 'A' && !$cell->getValue()){
                    $header = array_shift($table);
                    $datas = [];
                    foreach($table as $element){
                        $datas[] = array_combine($header, $element);
                    }
                    return $datas;
                }
                if($cell->getDataType() == 'n'){
                     $studentDatas[] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($cell->getValue());

                } else {
                    $studentDatas[] = $cell->getFormattedValue();
                }
            }
            $table[] = $studentDatas;
        }
        $header = array_shift($table);
        $datas = [];
        foreach($table as $element){
            $datas[] = array_combine($header, $element);
        }
        return $datas;
    }

}

