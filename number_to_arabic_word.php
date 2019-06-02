<?php
class NumberToWord{
    public $and = ' و';
    public function __construct()
    {
        
    }

    public function counvert($number = null)
    {
        if(!empty($number)){
            $_number = null;
            if(strlen($number) <= 2 && $number <= 20){

                return $this->lessTanTwenty($number);

            }elseif (strlen($number) <= 2 && $number < 100 && $number > 20) {

                $number = str_split($number);
                if($number[1] == 0){
                    return $this->betwwenTwentyAndHundred($number[0]);
                }
                return $this->digetWithAl($number[1]).$this->and.$this->betwwenTwentyAndHundred($number[0]);

            }elseif(strlen($number) > 2 && in_array($number,[100,1000,1000000,1000000000])){

                return $this->primaryBigNumber($number);

            }elseif(strlen($number) == 3 && $number < 1000){
                if(substr($number,0,1) > 2){
                    $_number = $this->moreTahnHundred(substr($number,0,1)).' '.$this->primaryBigNumber(100);
                }else{
                    $_number = $this->moreTahnHundred(substr($number,0,1));
                }
                
                if(substr($number,1,3) <= 20){
                    if(substr($number,1,3) != 00){
                        $_number .= $this->and.$this->forOneToTwnttey((int)substr($number,1,2));
                    }
                    
                }else{
                    if(substr($number,2,2) > 0){
                        $_number .= $this->and.$this->forOneToTwnttey(substr($number,2,2));
                    }
                    $_number .= $this->and.$this->betwwenTwentyAndHundred(substr($number,1,1),'');
                }
                
                return $_number;

            }elseif(strlen($number) >= 4 && $number < 1000000){
                $first = substr($number,0,1);
                $last = (int)substr($number,1,strlen($number));
                if(strlen($number) == 5){

                }elseif(strlen($number) == 7){

                }else{
                    if($first <= 2){
                        $_number.=$this->moreTahnThunsand($first);
                    }else{
                        $_number.=$this->moreTahnThunsand($first).' '.$this->nameByDiget(4);
                    }
                    if(substr($number,1,1)>0){
                        $_number.=$this->and.$this->moreTahnHundred(substr($number,1,1)).' ';
                    }
                    $_number.=$this->nameByDiget(3);
                    if((int)substr($number,2,2) <= 20 && (int)substr($number,2,2) !=0){
                        $_number.= $this->and.$this->forOneToTwnttey((int)substr($number,2,2));
                    }else{
                        if((int)substr($number,3,1) > 0){
                            $_number.=$this->and.$this->forOneToTwnttey((int)substr($number,3,1));
                        }
                        
                        if((int)substr($number,2,1) > 0){
                            $_number.=$this->and.$this->betwwenTwentyAndHundred((int)substr($number,2,1),'');
                        }
                        
                    }

                }
                $number = $_number;
            }
        }
        return $number;
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
    private function betwwenTwentyAndHundred($diget,$al='الـ')
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
 
    private function moreTahnHundred($diget)
    {
        $numbers = [
            1=>'مائة',
            2 =>'مائتين',
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
            8=>'تامنة',
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
    
    private function nameByDiget($digetLength)
    {
        $numbers = [
            3=>'مائة',
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

$numberToWord = new NumberToWord();
for($i=1;$i<=1500;$i++){
     
    echo " السنة ".$numberToWord->counvert($i).' - '.$i;
    echo "<br/>";
}

?>