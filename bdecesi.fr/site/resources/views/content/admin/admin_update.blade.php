@extends('../layouts.master')

@section('content')

<?php /*
	require 'database.php';

	if(!empty($_GET['id']))
	{
		$id = checkInput($_GET['id']);
	}

	$nameError = $descriptionError = $priceError = $imageError = $name = $description = $price = $image = "";

	if(!empty($_POST))
	{
		$name 			= checkInput($_POST['name']);
		$description 	= checkInput($_POST['description']);
		$price 		 	= checkInput($_POST['price']);
		$image 		 	= checkInput($_FILES['image']['name']);
		$imagePath 		= '../images/' . basename($image);
		$imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
		$isSuccess 		= true;

		if(empty($name))
		{
			$nameError = 'Ce champs ne peut pas être vide';
			$isSuccess = false;
		}

		if(empty($description))
		{
			$descriptionError = 'Ce champs ne peut pas être vide';
			$isSuccess = false;
		}

		if(empty($price))
		{
			$priceError = 'Ce champs ne peut pas être vide';
			$isSuccess = false;
		}

		if(empty($image))
		{
			$isImageUpdated = false;
		}

		else
		{
			$isImageUpdated = true;
			$isUploadSuccess = true;
			if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif")
			{
				$imageError = "Les fichiers autorisés sont : .jpg, .png, .jpeg, .gif";
				$isUploadSuccess = false;
			}

			if(!file_exists($imagePath))
			{
				$imageError = "Le fichier existe déjà";
				$isUploadSuccess = false;
			}

			if($_FILES["image"]["size"] > 500000)
			{
				$imageError = "Le fichier ne doit pas dépasser les 500Kb";
				$isUploadSuccess = false;
			}

			if($isUploadSuccess)
			{
				if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
				{
					$imageError = "Il y a eu une erreur lors de l'upload";
					$isUploadSuccess = false;
				}
			}
		}

		if(($isSuccess && $isImageUpdated && $isUploadSuccess) || ($isSuccess && !$isImageUpdated))
		{
			$db = Database::connect();
			if($isImageUpdated)
			{
				$statement = $db->prepare("UPDATE items set name = ?, description = ?, price = ?, image = ? WHERE id = ?");
			$statement->execute(array($name, $description, $price, $image, $id));
			}

			else
			{
				$statement = $db->prepare("UPDATE items set name = ?, description = ?, price = ? WHERE id = ?");
			$statement->execute(array($name, $description, $price, $id));
			}

			Database::disconnect();
			header("Location: index.php");
		}
		else if($isImageUpdated && !$isUploadSuccess)
		{
			$db = Database::connect();
			$statement = $db-> prepare("SELECT image FROM items WHERE id = ?");
			$statement->execute(array($id));
			$image 		= $item['image'];
			Database::disconnect();
		}


	}

	else
	{
		$db = Database::connect();
		$statement = $db->prepare("SELECT * FROM items WHERE id = ?");
		$statement->execute(array($id));

		$item = $statement->fetch();

		$name 			= $item['name'];
		$description	= $item['description'];
		$price 			= $item['price'];
		$image 			= $item['image'];

		Database::disconnect();
	}

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
            <h1><strong>Modifier un item</strong></h1>
            <br>
            <form class="form info" role="form" action="<?php /* echo'update.php?id=' . $id; */?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Nom :</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php /* echo $name; */?>">
                    <span class="help-inline"><?php /* echo $nameError; */?></span>
                </div>

                <div class="form-group">
                    <label for="description">Description :</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?php /* echo $description; */ ?>">
                    <span class="help-inline"><?php /* echo $descriptionError; */?></span>
                </div>

                <div class="form-group">
                    <label for="price">Prix : (en €)</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="<?php /* echo $price; */ ?>">
                    <span class="help-inline"><?php /* echo $priceError; */ ?></span>
                </div>

                <div class="form-group">
                    <label>Image :</label>
                    <p><?php /* echo $image; */?></p>
                    <label for="image">Sélectionner une image: </label>
                    <input type="file" id="image" name="image">
                    <span class="help-inline"><?php /* echo $imageError; */ ?></span>
                </div>


                <br>

                <div class="form-actions">
                    <button type="submit" href="../admin" class="btn btn-success">✏️ Modifier</button>
                    <a class="btn btn-warning" href="../admin">Retour</a>
                </div>
            </form>
        </div>

        <div class="col-sm-6">
            <div class="card">
                <img src="<?php /* echo '../images/' . $image; */ ?>" alt="...">
                <div class="price"><?php /* echo number_format((float)$price,2,'.','') . " €"; */ ?></div>
                <div class="caption">
                    <div class="divider"></div>
                    <h4><?php /* echo $name; */?></h4>

                    <p><?php /* echo $description; */ ?></p>
                    <a href="#" class="btn btn-order" role="button">🛒 COMMANDER</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')