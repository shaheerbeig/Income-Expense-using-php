<?php

declare(strict_types = 1);

function getTransactionFiles(string $currentfiledirectory) : array{
    //check if the directory exsits.
    $files = [];
    foreach(scandir($currentfiledirectory) as $_FILES){
        if(is_dir($_FILES)){
            continue;
        }
        $files[] = $currentfiledirectory . $_FILES;
    }
    return $files;
}


function extractData(string $filename) : array{

    //IF THE FILE DOESNOT EXSISTS WE WILL JUST TRIGGER AN ERROR
    if(!is_file($filename)){
        trigger_error("File" . $filename . "Doesnot Exsists" , E_USER_ERROR);
    }

    //IF THE FILE DO EXSISTS WE WILL OPEN IT AND WILL READ THE DATA
    $fptr = fopen($filename , "r");
    fgetcsv($fptr);

   $dataArray = [];
   while(($data = fgetcsv($fptr)) !== false){
        $dataArray[] = getData($data);
   }

   return $dataArray;
}

function getData(array $dataRow) : array{
    [$date , $check , $description , $amount] = $dataRow;

    //to ensure the correct format we will replace the dollar sign and the , sign
    $amount = (float) str_replace(["$",","],"" ,$amount);
    return [
        'date' => $date,
        'check'=> $check,
        'description'=> $description,
        'amount'=> $amount,
    ];
}

function totalSum(array $tarnsactions): array{
    $total = ['netTotal' => 0 , 'totalIncome' => 0 , 'totalExpense' => 0];

    foreach($tarnsactions as $value){
        $total['netTotal'] += $value['amount'];

        if($value['amount'] >= 0){
            $total['totalIncome'] += $value['amount'];
        }
        else if($value['amount'] <= 0){
            $total['totalExpense'] += $value['amount'];
        }

    }

    return $total;
}

function convertToDollar(float $value) :string{
    $negative = $value < 0;
    if($negative){
        return '-' . "$" . number_format(abs($value),2);
    }
    else{
        return "$" . number_format(abs($value),2);
    }
}

function dateFormat(string $date): string{
    return date('M d, Y' , strtotime($date));
}