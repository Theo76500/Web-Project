@extends('../layouts.master')

@section('content')

<?php /*
	require 'database.php';

	if(!empty($_GET['id']))
	{
		$id = checkInput($_GET['id']);

	}

	$db = Database::connect();
	$statement = $db->prepare('SELECT id, name, description, price, image FROM items WHERE id=?');

	$statement->execute(array($id));
	$item = $statement->fetch();

	Database::disconnect();

	function checkInput($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
*/ ?>

<div class="container admin">
	<div class="row">
		<div class="col-sm-6">
			<h1><strong>Voir un item</strong></h1>
			<br>
			<form class="info">
				<div class="form-group">
					<label><strong>Nom :</strong></label> <?php/* echo ' ' . $item['name']; */ ?>
				</div>

				<div class="form-group">
					<label><strong>Descprition :</strong></label> <?php/* echo ' ' . $item['description'];*/ ?>
				</div>

				<div class="form-group">
					<label><strong>Prix :</strong></label> <?php/* echo ' ' . number_format((float)$item['price'],2,'.','') . " €"; */?>
				</div>

				<div class="form-group">
					<label><strong>Image :</strong></label> <?php /*echo ' ' . $item['image']; */?>
				</div>
			</form>

			<br>

			<div class="form-actions">
				<a class="btn btn-warning" href="../admin">Retour</a>
			</div>


		</div>

		<div class="col-sm-6">
				<div class="card">
					<img src="<?php /*echo '../images/' . $item['image'];*/ ?>" alt="...">
					<div class="price"><?php /*echo number_format((float)$item['price'],2,'.','') . " €"; */?></div>
					<div class="caption">
						<div class="divider"></div>
						<h4><?php/* echo $item['name']; */?></h4>

						<p><?php /*echo $item['description'];*/ ?></p>
						<a href="#" class="btn btn-order" role="button"><span></span>🛒 COMMANDER</a>
					</div>
				</div>
			</div>
	</div>
</div>

@endsection('content')