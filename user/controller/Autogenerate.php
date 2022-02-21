<?php
    class AutoGenerate{

        public static function FormatString($number, $digitLength){
            $newNumber = null;
            for($i = 0; $i < $digitLength - strlen($number); $i ++){
                $newNumber .= "0";
            }
            return $newNumber.$number;
        }
        public static function InvoiceNumber($lastNumber, $invoiceType){
            $purchaseNumber = $invoiceType;
            $digitLength = 6;
            
            if($lastNumber == "0"){
                $purchaseNumber.= self::FormatString("1", $digitLength);
            }
            else{
                $number = array();
                $number = explode("-", $lastNumber);
                $nextNumber = (int)$number[1] + 1;
                $purchaseNumber.= self::FormatString((string)$nextNumber, $digitLength);
            }
            return $purchaseNumber;
        }
    }
   //echo AutoGenerate::InvoiceNumber("PUR-1", "PUR-");
?>