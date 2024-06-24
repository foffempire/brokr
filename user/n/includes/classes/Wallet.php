<?php 

class Wallet{
    private $kon;

    function __construct($kon){
        $this->kon = $kon;
    }

    function getWallets(){
        $query = $this->kon->prepare("SELECT * FROM wallets");
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($rows as $row) {
            $id = $row['id'];
            $addr = $row['wallet_address'];
            $type = $row['wallet_type'];
            $img = $row['qr_code'];

            echo "<tr>
                    <td>$type</td>
                    <td>$addr</td>
                    <td>
                        <a href='process?del_wallet=$id' onclick='return confirm(`Sure to delete?`)'><button class='btn btn-sm btn-primary'>Delete</button></a>
                    </td>
                </tr>";
        }
    }

    function delete($id){
        $query = $this->kon->prepare("DELETE FROM wallets WHERE id = :id ");
        $query->bindParam(":id", $id);
        return $query->execute();
    }


    function addWallet($address, $type, $img){
        $query = $this->kon->prepare("INSERT INTO wallets (wallet_type, wallet_address, qr_code) VALUES (:typ, :addr, :qr)");
        $query->bindParam(":addr", $address);
        $query->bindParam(":typ", $type);
        $query->bindParam(":qr", $img);
        return $query->execute();
    }

    function walletExist($type){
        $query = $this->kon->prepare("SELECT * FROM wallets WHERE wallet_type = :typ");
        $query->bindParam(":typ", $type);
        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        }
    }

    function selectCoin(){
        $active = 1;
        $query = $this->kon->prepare("SELECT * FROM coins WHERE is_active = '$active' ");
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($rows as $row){
            $name = $row['coin_name'];
            $slug = $row['coin_slug'];
            $img = $row['coin_img'];

            echo "
            <option value='$slug'>$name</option>
            ";
        }
    }

}



?>