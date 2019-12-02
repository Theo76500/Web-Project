@extends('../layouts.master')

@section('content')

<?php /*
	require 'database.php';

	if(!empty($_GET['id']))
	{
		$id = checkInput($_GET['id']);
	}

	if(!empty($_POST))
	{
		$id = checkInput($_POST['id']);
		$db = Database::connect();
		$statement = $db-> prepare("DELETE FROM items WHERE id = ?");

		$statement -> execute(array($id));

		Database::disconnect();
		header("Location: index.php");
	}


	function checkInput($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
*/?>

<div class="container admin">
    <div class="row">
        <h1><strong>Supprimer un item</strong></h1>
        <br />
        <form class="form col-lg-12 col-md-12 col-sm-12" role="form" action="delete.php" method="post">
            <input type="hidden" name="id" value="<?php /* echo $id; */ ?>" />
            <p class="alert alert-warning col-lg-12 col-md-12 col-sm-11">Êtes-vous sûr de vouloir supprimer ?</p>
            <div class="form-actions">
                <button type="submit" class="btn btn-warning">Oui</button>
                <a class="btn btn-white" href="../admin">Non</a>
            </div>
        </form>
    </div>
</div>

@endsection('content')
