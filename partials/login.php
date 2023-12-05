<?php
	require "./classes/TemporaryStorage.php";
	use Classes\TemporaryStorage;
	
	TemporaryStorage::sessionStart();
	$data_retrieved = TemporaryStorage::getData('login');
	TemporaryStorage::sessionEnd();
?>

<form action="./api.php" method="POST" class="d-flex flex-column align-items-center p-3 border rounded-2 shadow-sm" style=" width: 400px;">
	<div class="card d-flex p-2 border-0 w-100 mb-3 align-items-center" >
		<h3>Log in</h3>
	</div>

	<div class="card p-2 border-0 w-100 mb-3">
		<label for="email" class="form-label">Email address</label>
		<input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" value="<?php echo (isset($data_retrieved['email']) ? $data_retrieved['email'] : '') ?>">
	</div>
	<div class="card p-2 border-0 w-100 mb-3">
		<label for="password" class="form-label">Password</label>
		<input type="text" class="form-control" id="password" placeholder="Secure password" name="password" value="<?php echo (isset($data_retrieved['email']) ? $data_retrieved['password'] : '') ?>">
	</div>
	
	<input type="hidden" name="route" value="login">

	<button class="btn btn-primary">Log in</button>
</form>