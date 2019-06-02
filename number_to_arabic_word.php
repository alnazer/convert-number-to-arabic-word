<?php
class NumberToWord{
    public $and = ' و';
    public function __construct()
    {
        
    }
    public function convert($number)
    {
        $_number = null;
        if(strlen($number) <= 2){
            $_number.= $this->towLength($number);
        }elseif (strlen($number) == 3) {
            $_number.= $this->threewwLength($number);
        }elseif (strlen($number) == 4) {
            $_number.= $this->moreThanThreeLength(substr($number,0,1),3).$this->and.$this->threewwLength(substr($number,1,3),true);
        }elseif (strlen($number) == 5) {
            $_number.= $this->moreThanThreeLength(substr($number,0,2),4).$this->and.$this->threewwLength(substr($number,2,3),true);
        }elseif (strlen($number) == 6) {
            $_number.= $this->moreThanThreeLength(substr($number,0,3),6).$this->and.$this->threewwLength(substr($number,3,3),false);
        }elseif (strlen($number) == 7) {
            $_number.= $this->moreThanThreeLength(substr($number,0,1),7).$this->and.$this->threewwLength(substr($number,1,3),true,$this->nameByDiget(6)).$this->and.$this->threewwLength(substr($number,4,3));
        }

        return trim($_number,$this->and);
    }
    public function oneLength($number)
    {
        if($number <= 20){
           return $this->forOneToTwntteyNew($number);
        }
    }
    /** Formation tow diget */
    private function towLength($number){
        $_number = null;
        if($number <= 20){
            $_number = $this->forOneToTwntteyNew($number);
        }else{
            if(substr($number,1,1) > 0){
                $_number .= $this->digetWithAl(substr($number,1,1)).$this->and; 
            }
            $_number .= $this->betwwenTwentyAndHundred(substr($number,0,1)); 
        }
        return $_number;
    }
    /** Formation three diget */
    private function threewwLength($number,$removeAnd = false,$text=null){
        $_number = null;
        $firstNumber = substr($number,0,1);
        if($firstNumber > 0){
            $_number.=$this->moreTahnHundred($firstNumber);
        }
        
        $scoundNumber = substr($number,1,2);

        if($scoundNumber < 20 && $scoundNumber > 0){
            if(!$removeAnd){
                $_number .= $this->and;
            }
            $_number .= $this->forOneToTwntteyNew((int)$scoundNumber);
        }else{
            if(substr($scoundNumber,1,1) > 0){
                $_number .= $this->and.$this->forOneToTwntteyNew(substr($scoundNumber,1,1)); 
            }
            if(substr($scoundNumber,0,1) > 0){
                $_number .= $this->and.$this->betwwenTwentyAndHundred(substr($scoundNumber,0,1),''); 
            }
            $_number.=' '.$text;
        }
        return $_number;
    }
    /** Formating 4 diget */
    private function moreThanThreeLength($number,$length=3)
    {
        $_number = null;
         switch ($length) {
             case 3:
            {
                if($number < 10 && $number > 0){
                    $_number .= $this->moreTahnThunsand($number);   
                }
            }
            break;
            case 4:
            {
                if($number <= 10 && $number > 0){
                    $_number .= $this->forOneToTwntteyNew($number).' '.$this->nameByDiget(4);   
                }
            }
            break;
            case 6:
            {
                 
                if($number <= 100 && $number > 0){
                    $_number .= $this->threewwLength($number,true ).' '.$this->nameByDiget(6); 
                }
            }
            break;
            case 7:
            {
                 
                if($number <= 10 && $number > 0){
                    if($number == 1 || $number == 2){
                        $_number .= $this->moreMilone($number);
                    }else{
                        $_number .= $this->oneLength($number).' '.$this->nameByDiget(7); 
                    }
                      
                }
            }
            break;
             default:
                return $_number;
                 break;
         }
         return $_number ;
    }
   
    private function lessTanTwenty($diget)
    {
        $numbers = [
            1=>'الأولي',
            2=>'الثانية',
            3=>'الثالثة',
            4=>'الرابعة',
            5=>'الخامسة',
            6=>'السادسة',
            7=>'السابعة',
            8=>'الثامنة',
            9=>'التاسعة',
            10=>'العاشرة',
            11=>'الحادية عشر',
            12=>'الثانية عشر',
            13=>'الثالثة عشر',
            14=>'الرابعة عشر',
            15=>'الخامسة عشر',
            16=>'السادسة عشر',
            17=>'السابعة عشر',
            18=>'الثامنة عشر',
            19=>'التاسعة عشر',
            20=>'العشرون',
        ];
        if(array_key_exists($diget,$numbers)){
            return $numbers[$diget];
        }
        return $diget;
    }
    private function betwwenTwentyAndHundred($diget,$al='ال')
    {
        $numbers = [
         
            2=>$al.'عشرون',
            3=>$al.'ثلاثون',
            4=>$al.'اربعون',
            5=>$al.'خمسون',
            6=>$al.'ستون',
            7=>$al.'سبعون',
            8=>$al.'ثمانون',
            9=>$al.'تسعون',
        ];
        if(array_key_exists($diget,$numbers)){
            return $numbers[$diget];
        }
        return $diget;
    }
    private function digetWithAl($diget)
    {
        $numbers = [
            1=>'الواحدة',
            2=>'الثانية',
            3=>'الثالثة',
            4=>'الرابعة',
            5=>'الخامسة',
            6=>'السادسة',
            7=>'السابعة',
            8=>'الثامنة',
            9=>'التاسعة',
        ];
        if(array_key_exists($diget,$numbers)){
            return $numbers[$diget];
        }
        return $diget;
    }

    private function primaryBigNumber($diget)
    {
        $numbers = [
            100=>'مائة',
            200 =>'مائتين',
            1000 =>'الف',
            2000=>'الفين',
            1000000=>'مليون',
            1000000000=>'مليار'
        ];
        if(array_key_exists($diget,$numbers)){
            return $numbers[$diget];
        }
        return $diget;
    }
    private function moreMilone($diget)
    {
        $numbers = [
            1=>'مليون',
            2 =>'مليونان',
        ];
        if(array_key_exists($diget,$numbers)){
            return $numbers[$diget];
        }
        return $diget;
    }
    private function moreTahnHundred($diget)
    {
        $numbers = [
            1=>'مائة',
            2 =>'مائتان',
            3 =>'ثلاثمائة',
            4=>'اربعمائة',
            5=>'خمسمائة',
            6=>'ستمائة',
            7=>'سبعمائة',
            8=>'ثمانيمائة',
            9=>'تسعمائة',
        ];
        if(array_key_exists($diget,$numbers)){
            return $numbers[$diget];
        }
        return $diget;
    }
    private function moreTahnThunsand($diget)
    {
        $numbers = [
            1=>'الف',
            2 =>'الفان',
            3 =>'ثلاثة',
            4=>'أربعة',
            5=>'خمسة',
            6=>'ستة',
            7=>'سبعة',
            8=>'ثمان',
            9=>'تسعة',
        ];
        if(array_key_exists($diget,$numbers)){
            return $numbers[$diget];
        }
        return $diget;
    }
    private function forOneToTwnttey($diget)
    {
        $numbers = [
            1=>'واحد',
            2=>'اثنين',
            3=>'ثلاثة',
            4=>'أربعة',
            5=>'خمسة',
            6=>'ستة',
            7=>'سبعة',
            8=>'ثمانية',
            9=>'تسعة',
            10=>'عشرة',
            11=>'الحادي عشر',
            12=>'الثاني عشر',
            13=>'الثالث عشر',
            14=>'الرابع عشر',
            15=>'الخامس عشر',
            16=>'السادس عشر',
            17=>'السابع عشر',
            18=>'الثامن عشر',
            19=>'التاسع عشر',
            20=>'العشرون',
        ];
        if(array_key_exists($diget,$numbers)){
            return $numbers[$diget];
        }
        return $diget;
    }
    private function forOneToTwntteyNew($diget)
    {
        $numbers = [
            1=>'واحد',
            2=>'اثنان',
            3=>'ثلاثة',
            4=>'أربعة',
            5=>'خمسة',
            6=>'ستة',
            7=>'سبعة',
            8=>'ثمانية',
            9=>'تسعة',
            10=>'عشرة',
            11=>'أحد عشر',
            12=>'إثنا عشر',
            13=>'ثلاثة عشر',
            14=>'أربعة عشر',
            15=>'خمسة عشر',
            16=>'ستة عشر',
            17=>'سبعة عشر',
            18=>'ثمانية عشر',
            19=>'تسعة عشر',
            20=>'عشرون',
        ];
        if(array_key_exists($diget,$numbers)){
            return $numbers[$diget];
        }
        return $diget;
    }
    private function nameByDiget($digetLength)
    {
        $numbers = [
            3=>'مائة',
            6=>'الف',
            4=>'الأف',
            7 =>'ملايين',
            10 =>'مليارات',
            13=>'بلايين',
        ];
        if(array_key_exists($digetLength,$numbers)){
            return $numbers[$digetLength];
        }
        return $digetLength;
    }
}

?>
