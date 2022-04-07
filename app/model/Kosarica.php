<?php
class Kosarica{

	public static function read()
    {
        $veza = DB::getInstanca();
        $izraz = $veza->prepare('
        
            select * from jelo
        
        '); 
        $izraz->execute();
        return $izraz->fetchAll();
    }
}


if(isset($_POST["add"])){
	if(isset($_SESSION["cart"])){
		$item_array_id = array_column($_SESSION["cart"], "sifra");
		if(!in_array($_GET["sifra"], $item_array_id)){
			$count = count($_SESSION["cart"]);
			$item_array = array(
				'sifra' => $_GET["sifra"],
				'naziv' => $_POST["naziv"],
				'cijena' => $_POST["cijena"],				
				'ukupno' => $_POST["ukupno"]
			);
			$_SESSION["cart"][$count] = $item_array;
			echo '<script>window.location="Kosarica.php"</script>';
		} else {					
			echo '<script>window.location="Kosarica.php"</script>';
		}
	} else {
		$item_array = array(
			'sifra' => $_GET["sifra"],
			'naziv' => $_POST["naziv"],
			'cijena' => $_POST["cijena"],
			'ukupno' => $_POST["ukupno"],
			
		);
		$_SESSION["cart"][0] = $item_array;
	}
	if (isset($_GET['clear'])) {
		$stmt = $conn->prepare('DELETE FROM cart');
		$stmt->execute();
		$_SESSION['showAlert'] = 'block';
		$_SESSION['message'] = 'All Item removed from the cart!';
		header('location:kosarica.php');
	  }
}

