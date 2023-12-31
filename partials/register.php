<?php 
include __DIR__ . "/../classes/TemporaryStorage.php";
use Classes\TemporaryStorage;

TemporaryStorage::sessionStart();
$errors		= TemporaryStorage::getData('register_errors');
$register	= TemporaryStorage::getData('register');
$success	= TemporaryStorage::getData('register_success');
TemporaryStorage::sessionEnd();
?>

<?php if (!isset($success)) { ?>
	<form action="./api.php" method="POST" class="d-flex flex-column align-items-center p-3 border rounded-2 shadow-sm" style=" width: 400px;">
		<div class="card d-flex p-2 border-0 w-100 mb-3 align-items-center" >
			<h3>Register</h3>
		</div>

		<div class="card p-2 border-0 w-100 mb-3" >
			<label for="name" class="form-label">Name</label>
			<input type="text" class="form-control" id="name" placeholder="John Doe" name="name" value=<?php echo (isset($register['name']) ? $register['name'] : '') ?>>
			<?php
				if (isset($errors['name'])) {
					foreach ($errors['name'] as $name) {
						echo "<p class='text-danger text-center'>{$name}</p>";
					}
				}
			?>
		</div>

		<div class="card w-100 border-0 p-2">
			<h6>Gender</h6>
			<div class="card w-100 d-flex flex-row justify-content-around mb-3 border-0">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="male" <?php echo ((isset($register['gender']) && $register['gender'] === 'male') ? 'checked' : '') ?>>
					<label class="form-check-label" for="flexRadioDefault1">
						Male
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="female" <?php echo ((isset($register['gender']) && $register['gender'] === 'female') ? 'checked' : '') ?>>
					<label class="form-check-label" for="flexRadioDefault2">
						Female
					</label>
				</div>
			</div>
			<p class="text-danger text-center"><?php echo (isset($errors['gender']) ? $errors['gender'][0] : '') ?></p>
		</div>

		<div class="card p-2 border-0 w-100 mb-3">
			<label for="email" class="form-label">Email address</label>
			<input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" value=<?php echo (isset($register['email']) ? $register['email'] : '') ?>>
			<?php
				if (isset($errors['email'])) {
					foreach ($errors['email'] as $email) {
						echo "<p class='text-danger text-center'>{$email}</p>";
					}
				}
			?>
		</div>
		<div class="card p-2 border-0 w-100 mb-3">
			<label for="password" class="form-label">Password</label>
			<input type="text" class="form-control" id="password" placeholder="Secure password" name="password" value=<?php echo (isset($register['password']) ? $register['password'] : '') ?>>
			<?php
				if (isset($errors['password'])) {
					foreach ($errors['password'] as $password) {
						echo "<p class='text-danger text-center'>{$password}</p>";
					}
				}
			?>
		</div>
		<div class="card p-2 border-0 w-100 mb-3">
			<label for="password_repeat" class="form-label">Password repeat</label>
			<input type="text" class="form-control" id="password_repeat" placeholder="Repeat password" name="password_repeat" value=<?php echo (isset($register['password_repeat']) ? $register['password_repeat'] : '') ?>>
			<?php
				if (isset($errors['password_repeat'])) {
					foreach ($errors['password_repeat'] as $password_repeat) {
						echo "<p class='text-danger text-center'>{$password_repeat}</p>";
					}
				}
			?>
		</div>

		<input type="hidden" name="route" value="register">

		<button class="btn btn-primary">Register</button>
	</form>
<?php } else { ?>
	<div class="alert alert-success">
		<?php echo $success['success']; ?>
	</div>
<?php } ?>