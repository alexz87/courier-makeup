<?php

    if ($_COOKIE['login'] == '') {
        header('Location: /user/auth');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="<?=$data['lang']?>">

	<?php require 'public/blocks/head.php'; ?>
	
	<body>

		<?php require 'public/blocks/header.php'; ?>
		
		<div class="block container">
			<div class="contact d-flex col align-center mt-5 mb-5">
				<div class="mb-5"><h1>Контакти</h1></div>
				<div class="box d-flex col align-center">
					<div class="text p-2">
						<p>Мене звуть:</p>
						<h3>Олександр Задорожній</h3><br>
						<p>
							Я web програміст, і це тестовий додаток для підрахунку каси, та для запису виконаних замовлень! 
							Корисьуватись додатком можливо всім бажаючим.
						</p><br>
						<p>
							Якщо у вас є якісь питання, або побажання стосовно додатку. Ви можете написати у форму, 
							або іншими доступними способами нижче!
						</p><br>
						<p><b>Мій телефон:</b> <a href="tel:+380939947369" class="warning">+38 (093) 994 - 73 - 69</a></p>
                    	<p><b>Мій email:</b> <a href="mailto:admin@alexproger.com" class="warning">admin@alexproger.com</a></p><br>
					</div>
					<div class="telegram p-1 d-flex col align-center">
						<h3 class="mb-1">Напишіть (telegram):</h3>
						<input class="border p-1 mb-1" type="text" id="name" placeholder="Введіть ім'я">
						<input class="border p-1 mb-1" type="tel" id="tel" pattern="[0-9]{10}" placeholder="Введіть телефон (0931234567)">
						<textarea class="border p-1 mb-1" id="mess" placeholder="Введіть повідомлення"></textarea>
						<button class="btn btn-warning" id="btn-teleg">Надіслати</button>
					</div>
				</div>
				<div class="mt-5"><h5>Всі права захищені</h5></div>
			</div>
		</div>

		<?php require 'public/blocks/footer.php'; ?>
		
		<script src="public/js/jquery360.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>
			$('#btn-teleg').click(function() {
				$('#btn-teleg').attr('class', 'btn btn-success');
				$('#btn-teleg').html('Дякую');
				setTimeout(function() {
					$('#btn-teleg').attr('class', 'btn btn-warning');
					$('#btn-teleg').html('Надіслати');
				}, 1000);
				let name = $('#name').val();
				let tel = $('#tel').val();
				let mess = $('#mess').val();

				$.ajax({
					url: 'public/php/telegram.php',
					type: 'POST',
					data: {'name' : name, 'tel' : tel, 'mess' : mess},
					dataType: 'html',
					cache: false,
					success: function(data) {
						if (data == 'error') {
							$('#btn-teleg').attr('class', 'btn btn-danger');
							$('#btn-teleg').html('Помилка');
							setTimeout(function() {
								$('#btn-teleg').attr('class', 'btn btn-warning');
								$('#btn-teleg').html('Надіслати');
							}, 1000);
						} else {
							$('#name').val('');
							$('#tel').val('');
							$('#mess').val('');
						}
					} 
				});
			});
		</script>
	</body>
</html>