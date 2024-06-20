<?php 

class Coin{
    private $kon;
    private $data;

    function __construct($kon){
        $this->kon = $kon;
        $active = 1;
        $query = $this->kon->prepare("SELECT * FROM coins WHERE is_active = '$active' ");
        $query->execute();
        $this->data = $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function selectCoin(){
        foreach($this->data as $row){
            $name = $row['coin_name'];
            $slug = $row['coin_slug'];
            $img = $row['coin_img'];

            echo "
            <option value='$slug'>$name</option>
            ";
        }
    }

    function coinName($slug){
        $query = $this->kon->prepare("SELECT * FROM coins WHERE coin_slug = '$slug' ");
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row['coin_name'];
    }

    function coinAddress($slug){
        $query = $this->kon->prepare("SELECT * FROM wallets WHERE wallet_type = '$slug' ");
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if(!$row){
            return Helper::defaultAddress($slug);
        }else{
            return $row['wallet_address'];
        }
    }

    function coinQrcode($slug){
        $query = $this->kon->prepare("SELECT * FROM wallets WHERE wallet_type = '$slug' ");
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if(!$row){
            return Helper::defaultQrcode($slug);
        }else{
            return "ad_min/assets/img/qrcode/".$row['qr_code'];
        }
    }

}



?>