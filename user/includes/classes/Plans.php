<?php  

	/**
	 * 
	 */
	class Plans 
	{
		private $kon;
		private $id;
		private $data;

		function __construct($kon, $id="")
		{
			$this->kon = $kon;
			$this->id = $id;
			$stmt = $this->kon->prepare("SELECT * FROM plans WHERE id = :id ");
			$stmt->bindParam(":id", $this->id);
			$stmt->execute();
			$this->data = $stmt->fetch(PDO::FETCH_ASSOC);
		}

		function id(){
			return $this->data['id'];
		}
		function name(){
			return $this->data['name'];
		}
		function amount(){
			return $this->data['amount'];
		}

		
		function allPlans(){
			$stmt = $this->kon->prepare("SELECT * FROM plans ");
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($rows as $row){
				$id = $row['id'];
				$name = $row['name'];
				$amt = number_format($row['amount'],2);
				$returns = number_format($row['returns'],2);
				echo "<option value='$id'>$name $$amt - $$returns</option>";
			}
		}

		function listPlans(){
			$stmt = $this->kon->prepare("SELECT * FROM plans ");
			$stmt->execute();
			$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

			foreach ($rows as $row) {
				echo "
				<div class='col-md-3'>
	                <h4>{$row['name']}</h4>                    
	            </div>
				";
			}
		}
		

	}
?>