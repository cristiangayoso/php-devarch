<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHP-DevArch :: CodeIgniter 4</title>
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
							if(!empty($users)) {
								foreach($users as $row) {
							?>
							<tr>
						      	<td scope="row"><?php echo $row['id']; ?></td>
						      	<td><?php echo $row['login']; ?></td>
						      	<td>
						      		<a href="<?php echo base_url("edit/". $row['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
						      		<a href="<?php echo base_url("delete/". $row['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
						      	</td>
						    </tr>
				    	<?php
				    		}
				    	}
				    	?>
						</tbody>
					</table>
				</div>
				<div class="col-md-4">
					<h3>Form</h3>
					<?php
					$action = !empty($user["id"]) ? "update" : "create";
					?>
					<form class="form-class" method="post" action="<?php echo base_url($action); ?>">
						<div class="form-group">
							<label>Login</label>
							<input type="text" name="login" class="form-control" value="<?php echo $user["login"] ?? ""; ?>">
						</div>
						<div class="form-group mt-3">
							<label>Password</label>
							<input type="password" name="password" class="form-control">
						</div>
						<div class="form-group">
							<label class="w-100">&nbsp;</label>
							<input type="hidden" name="id-edit" class="form-control" value="<?php echo $user["id"] ?? ""; ?>">
							<input type="submit" name="submit" class="btn btn-primary float-end" value="Submit">
							<?php
								if(!empty($user)) {
							?>
							<a class="btn btn-light float-start" href="<?php echo base_url(); ?>">Cancel</a>
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