<?php
$dbUser = "root";
$dbPassword = "mysql2023!";
$dbName = "php_frameworks";

$db = null;
$login = ""; 

try {
  $db = new PDO("mysql:host=localhost;dbname=$dbName", $dbUser, $dbPassword);
} catch (PDOException $e) {
	$infoMessage = (object) ["message" => $e->getMessage(), "class" => "danger"];
}

if(!is_null($db)) {
	if(!empty($_GET["id"])) {
		$user = $db->query("SELECT id, login FROM users WHERE id = " . $_GET["id"])->fetch();
		if(empty($user)) {
				$infoMessage = (object) ["message" => "User not found", "class" => "warning"];
		} else {
			$login = $user["login"];
		}
	}

	try {
		if(!empty($_GET["action"]) && $_GET["action"] == "delete") {
			if(!empty($user["id"])) {
				$res = $db->query("DELETE FROM users WHERE id = " . $user["id"]);
				$infoMessage = (object) ["message" => "User deleted successfully", "class" => "success"];
				unset($user, $login);
			}
		}

		if(!empty($_POST["login"]) && !empty($_POST["password"])) {
			if(!empty($_POST["id-edit"])) {
				$res = $db->query("UPDATE users SET login = '" . $_POST["login"] . "', password = '" . sha1($_POST["password"]) . "' WHERE id = " . $_POST["id-edit"]);
				$infoMessage = (object) ["message" => "User updated successfully", "class" => "success"];
			} else {
				$res = $db->query("INSERT INTO users(login, password) VALUES('" . $_POST["login"] . "', '" . sha1($_POST["password"]) . "')");
				$infoMessage = (object) ["message" => "User created successfully", "class" => "success"];
			}
			unset($_POST);
		}
	} catch (PDOException $e) {
		$infoMessage = (object) ["message" => $e->getMessage(), "class" => "danger"];
	}
}

$users = $db->query("SELECT id, login FROM users");

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.0/assets/css/docs.css" rel="stylesheet">
  </head>
  <body>
		<div class="container">
			<div class="row">
				<?php
				if(!empty($infoMessage)) {
				?>
				<div class="alert alert-<?php echo $infoMessage->class; ?>" role="alert">
				  <?php echo $infoMessage->message; ?>
				</div>
				<?php
				}
				?>
				<div class="col-md-8">
					<h3>Users</h3>
					<table class="table table-striped">
						<thead>
							<tr>
				      	<th scope="col">#</th>
				      	<th scope="col">Login</th>
				      	<th scope="col">&nbsp;</th>
				    	</tr>
						</thead>
						<tbody>
							<?php
							foreach($users as $row) {
							?>
							<tr>
				      	<td scope="row"><?php echo $row['id']; ?></td>
				      	<td><?php echo $row['login']; ?></td>
				      	<td>
				      		<a href="index.php?action=edit&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
				      		<a href="index.php?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
				      	</td>
				    	</tr>
				    	<?php
				    	}
				    	?>
						</tbody>
					</table>
				</div>
				<div class="col-md-4">
					<h3>Form</h3>
					<form class="form-class" method="post">
						<div class="form-group">
							<label>Login</label>
							<input type="text" name="login" class="form-control" value="<?php echo $login ?>">
						</div>
						<div class="form-group mt-3">
							<label>Password</label>
							<input type="password" name="password" class="form-control">
						</div>
						<div class="form-group">
							<label class="w-100">&nbsp;</label>
							<input type="hidden" name="id-edit" class="form-control" value="<?php echo !empty($user["id"]) ? $user["id"] : ""; ?>">
							<input type="submit" name="submit" class="btn btn-primary float-end" value="Submit">
							<?php
								if(!empty($_GET["action"])) {
							?>
							<a class="btn btn-light float-start" href="<?php echo $_SERVER['SCRIPT_NAME']; ?>">Cancel</a>
							<?php
								}
							?>
						</div>
					</form>
				</div>
			</div>
		</div>

  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>