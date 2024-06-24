<?php 

class Transactions{
    private $kon;

    function __construct($kon){
        $this->kon = $kon;
    }


    function investments(){
        $stmt = $this->kon->prepare("SELECT * FROM investments ORDER BY id DESC");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $n=0;
        if(empty($rows)){
            echo " <h4>No transactions</h4>";
        }else{
            foreach($rows as $row){
                $n++;
                $id = $row['id'];
                $email = $row['email'];
                $tid = $row['transaction_id'];
                $currency = $row['gateway'];
                $status = $row['status'];
                $date = $row['date_added'];
                $packName = $row['package'];
                $packAmt = $row['amount'];
                if($status == 'pending'){
                    $btn1 = "<a href='process?confirmInvest=$id' onclick='return confirm(`Are you sure?`)'><button class='btn btn-sm btn-success'>mark as completed </button></a>";
                    $btn2 = "<a href='process?runningInvest=$id' onclick='return confirm(`Sure to delete?`)'><button class='btn btn-sm btn-warning'>mark as running</button></a>";
                    $btn3 = "<a href='process?deleteInvest=$id' onclick='return confirm(`Sure to delete?`)'><button class='btn btn-sm btn-danger'>Delete</button></a>";
                }
                elseif($status == 'running'){
                    $btn1 = "<a href='process?confirmInvest=$id' onclick='return confirm(`Are you sure?`)'><button class='btn btn-sm btn-success'>mark as completed </button></a>";
                    $btn2 = "<a href='process?undoConfirmInvest=$id' onclick='return confirm(`Are you Sure?`)'><button class='btn btn-sm btn-primary'>mark as pending</button></a>";
                    $btn3='';
                }
                else{
                    $btn1 = "<a href='process?undoConfirmInvest=$id' onclick='return confirm(`Are you sure?`)'><button class='btn btn-sm btn-primary'>mark as pending</button></a>";
                    $btn2 = "";
                    $btn3 = "";
                }
                echo "
                <tr>
                    <td>$n</td>
                    <td>$email</td>
                    <td>$packName</td>
                    <td>$currency</td>
                    <td>$packAmt</td>
                    <td>$status</td>
                    <td>$date</td>
                    <td>$btn1</td>
                    <td>$btn2</td>
                    <td>$btn3</td>
                </tr>";
            }
        }
    }
    function queriedInvestments($query){
        $stmt = $this->kon->prepare("SELECT * FROM investments WHERE status = :stat ORDER BY id DESC");
        $stmt->bindParam(":stat", $query);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $n=0;
        if(empty($rows)){
            echo "<h4>No transactions</h4>";
        }else{
            foreach($rows as $row){
                $n++;
                $id = $row['id'];
                $email = $row['email'];
                $tid = $row['transaction_id'];
                $currency = $row['gateway'];
                $status = $row['status'];
                $date = $row['date_added'];
                $packName = $row['package'];
                $packAmt = $row['amount'];
                $alertMsg = "Sure to delete?";
                if($status == 'pending'){
                    $btn1 = "<a href='process?confirmInvest=$id' onclick='return confirm(`Are you sure?`)'><button class='btn btn-sm btn-success'>mark as completed </button></a>";
                    $btn2 = "<a href='process?runningInvest=$id' onclick='return confirm(`Sure to delete?`)'><button class='btn btn-sm btn-warning'>mark as running</button></a>";
                    $btn3 = "<a href='process?deleteInvest=$id' onclick='return confirm(`Sure to delete?`)'><button class='btn btn-sm btn-danger'>Delete</button></a>";
                }
                elseif($status == 'running'){
                    $btn1 = "<a href='process?confirmInvest=$id' onclick='return confirm(`Are you sure?`)'><button class='btn btn-sm btn-success'>mark as completed </button></a>";
                    $btn2 = "<a href='process?undoConfirmInvest=$id' onclick='return confirm(`Are you Sure?`)'><button class='btn btn-sm btn-primary'>mark as pending</button></a>";
                    $btn3='';
                }
                else{
                    $btn1 = "<a href='process?undoConfirmInvest=$id' onclick='return confirm(`Are you sure?`)'><button class='btn btn-sm btn-primary'>mark as pending</button></a>";
                    $btn2 = "";
                    $btn3 = "";
                }
                echo "
                <tr>
                    <td>$n</td>
                    <td>$email</td>
                    <td>$packName</td>
                    <td>$currency</td>
                    <td>$packAmt</td>
                    <td>$status</td>
                    <td>$date</td>
                    <td>$btn1</td>
                    <td>$btn2</td>
                    <td>$btn3</td>
                </tr>";
            }
        }
    }


    function confirmInvest($id){
        $stat = "completed";
        $query = $this->kon->prepare("UPDATE investments SET status = :stat WHERE id = :id ");
        $query->bindParam(":stat", $stat);
        $query->bindParam(":id", $id);
        return $query->execute();
    }
    function runningInvest($id){
        $stat = "running";
        $query = $this->kon->prepare("UPDATE investments SET status = :stat WHERE id = :id ");
        $query->bindParam(":stat", $stat);
        $query->bindParam(":id", $id);
        return $query->execute();
    }
    function undoConfirmInvest($id){
        $stat = "pending";
        $query = $this->kon->prepare("UPDATE investments SET status = :stat WHERE id = :id ");
        $query->bindParam(":stat", $stat);
        $query->bindParam(":id", $id);
        return $query->execute();
    }
    function deleteInvest($id){
        $query = $this->kon->prepare("DELETE FROM investments WHERE id = :id ");
        $query->bindParam(":id", $id);
        return $query->execute();
    }


    // **************************withdrawals *******************************
    function withdrawals(){
        $stmt = $this->kon->prepare("SELECT * FROM withdrawals ORDER BY id DESC");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $n=0;
        if(empty($rows)){
            echo "<h3>No transactions</h3>";
        }else{
            foreach($rows as $row){
                $n++;
                $id = $row['id'];
                $email = $row['email'];
                $addr = $row['wallet_address'];
                $currency = $row['wallet_type'];
                $amount = $row['amount'];
                $status = $row['status'];
                $date = $row['date_added'];
                if($status == 'pending'){
                    $btn1 = "<a href='process?confirmwithdraw=$id' onclick='return confirm(`Are you sure?`)'><button class='btn btn-sm btn-warning'>mark as completed  </button></a>";
                    $btn2 = "<a href='process?deletewithdraw=$id' onclick='return confirm(`Sure to delete?`)'><button class='btn btn-sm btn-danger'>Delete</button></a>";
                }else{
                    $btn2 = "";
                    $btn1 = "<a href='process?undoConfirmwithdraw=$id' onclick='return confirm(`Are you sure?`)'><button class='btn btn-sm btn-primary'>Unmark</button></a>";
                }
                echo "
                <tr>
                    <td>$n</td>
                    <td>$email</td>
                    <td>$currency</td>
                    <td>$addr</td>
                    <td>$$amount</td>
                    <td>$status</td>
                    <td>$date</td>
                    <td>$btn1</td>
                    <td>$btn2</td>
                </tr>";
            }
        }
    }
    function queriedWithdrawals($query){
        $stmt = $this->kon->prepare("SELECT * FROM withdrawals WHERE status = :stat ORDER BY id DESC");
        $stmt->bindParam(":stat", $query);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $n=0;
        if(empty($rows)){
            echo "<h3>No transactions</h3>";
        }else{
            foreach($rows as $row){
                $n++;
                $id = $row['id'];
                $email = $row['email'];
                $addr = $row['wallet_address'];
                $currency = $row['wallet_type'];
                $amount = $row['amount'];
                $status = $row['status'];
                $date = $row['date_added'];
                if($status == 'pending'){
                    $btn1 = "<a href='process?confirmwithdraw=$id' onclick='return confirm(`Are you sure?`)'><button class='btn btn-sm btn-warning'>mark as completed </button></a>";
                    $btn2 = "<a href='process?deletewithdraw=$id' onclick='return confirm(`Sure to delete?`)'><button class='btn btn-sm btn-danger'>Delete</button></a>";
                }else{
                    $btn2 = "";
                    $btn1 = "<a href='process?undoConfirmwithdraw=$id' onclick='return confirm(`Are you sure?`)'><button class='btn btn-sm btn-primary'>Unmark</button></a>";
                }
                echo "
                <tr>
                    <td>$n</td>
                    <td>$email</td>
                    <td>$currency</td>
                    <td>$addr</td>
                    <td>$$amount</td>
                    <td>$status</td>
                    <td>$date</td>
                    <td>$btn1</td>
                    <td>$btn2</td>
                </tr>";
            }
        }
    }
    function confirmWithdraw($id){
        $stat = "completed";
        $query = $this->kon->prepare("UPDATE withdrawals SET status = :stat WHERE id = :id ");
        $query->bindParam(":stat", $stat);
        $query->bindParam(":id", $id);
        return $query->execute();
    }
    function undoConfirmWithdraw($id){
        $stat = "pending";
        $query = $this->kon->prepare("UPDATE withdrawals SET status = :stat WHERE id = :id ");
        $query->bindParam(":stat", $stat);
        $query->bindParam(":id", $id);
        return $query->execute();
    }
    function deleteWithdraw($id){
        $query = $this->kon->prepare("DELETE FROM withdrawals WHERE id = :id ");
        $query->bindParam(":id", $id);
        return $query->execute();
    }

}



?>