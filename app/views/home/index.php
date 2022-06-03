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
			
			<?php if ($_COOKIE['login'] == 'admin'): ?>

				<div class="mycash">
					<h3>Мої кошти:</h3>
					<form action="/" method="post" class="inform">
						<input type="number" name="myCash" id="myCash" placeholder="Мої кошти" class="my-cash">
						<button class="btn btn-dark" id="my-cash-btn">Додати</button>
						<div class="my-cash warning"><b><?=$data['myCash']?> UAH</b></div>
					</form>
					<div class="hr"></div>
					<h3>Витрачені чайові:</h3>
					<form action="/" method="post" class="inform">
						<input type="number" name="spentTips" id="spentTips" placeholder="Чайові" class="my-tip">
						<button class="btn btn-warning" id="my-cash-btn">Додати</button>
						<div class="my-tip danger"><b><?=$data['spentTips']?> UAH</b></div>
					</form>
				</div>
				<div class="hr"></div>

			<?php endif; ?>

			<div class="cash">
				<h3>Підрахунок каси:</h3>
				<form action="/" method="post" class="inform">
					<input type="number" name="banknotes1000" id="1000" placeholder="1000 UAH" class="banknotes">
					<input type="number" name="banknotes500" id="500" placeholder="500 UAH" class="banknotes">
					<input type="number" name="banknotes200" id="200" placeholder="200 UAH" class="banknotes">
					<input type="number" name="banknotes100" id="100" placeholder="100 UAH" class="banknotes">
					<input type="number" name="banknotes50" id="50" placeholder="50 UAH" class="banknotes">
					<input type="number" name="banknotes20" id="20" placeholder="20 UAH" class="banknotes">
					<input type="number" name="banknotes10" id="10" placeholder="10 UAH" class="banknotes">
					<input type="number" name="banknotes5" id="5" placeholder="5 UAH" class="banknotes">
					<input type="number" name="banknotes2" id="2" placeholder="2 UAH" class="banknotes">
					<input type="number" name="banknotes1" id="1" placeholder="1 UAH" class="banknotes">
					<input type="number" name="paydesk" id="paydesk" placeholder="Каса UAH" class="paydesk">
					<input type="hidden" name="cash" id="cash" class="banknotes">
					<input type="hidden" name="tip" id="tip" class="banknotes">
					<button class="btn btn-dark" id="cash-btn">Рахувати</button>
				</form>
				<div class="info"><?=$data['info']?></div>
			</div>
			<div class="hr"></div>
			<div class="orders">
				<h3>Кількість заказів:</h3>
				<form action="/" method="post" class="inform">
					<input type="number" name="orders" id="orders" placeholder="Замовлення" class="all-orders">
					<input type="number" name="newPost" id="newPost" placeholder="НП" class="all-orders">
					<button class="btn btn-dark" id="orders-btn">Додати</button>
				</form>
				<div class="menu-orders">
					<div class="everyday">
						<div><h4>Буденні дні:</h4></div>
						<div><h5>Замовлення: <?=$data['orders']?> шт.</h5></div>
						<div><h5>Нова Пошта: <?=$data['newPost']?> шт.</h5></div>
					</div>
					<div class="weekend">
						<div><h4>Вихідні дні:</h4></div>
						<div><h5>Замовлення: <?=$data['weekendOrders']?> шт.</h5></div>
						<div><h5>Нова Пошта: <?=$data['weekendNewPost']?> шт.</h5></div>
					</div>
				</div>

				<?php if ($data['fullOrders'] < 1000): ?>

					<div class="full-orders warning"><h2>Замовлення: <?=$data['fullOrders']?> шт.</h2></div>

				<?php else: ?>

					<div class="full-orders success"><h2>Замовлення: <?=$data['fullOrders']?> шт.</h2></div>

				<?php endif;?>
				<?php if ($data['salary'] < 15000): ?>

					<div class="salary"><h2 class="danger">ЗП: <?=$data['salary']?> UAH</h2></div>

				<?php elseif ($data['salary'] < 20000): ?>

					<div class="salary"><h2 class="warning">ЗП: <?=$data['salary']?> UAH</h2></div>

				<?php else: ?>

					<div class="salary"><h2 class="success">ЗП: <?=$data['salary']?> UAH</h2></div>

				<?php endif;?>
			</div>
		</div>

		<?php require 'public/blocks/footer.php'; ?>
		
		<script src="public/js/jquery360.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>
			let res = 0;
			let tip = 0;

			$('#cash-btn').click(function() {
				let paydesk = $('#paydesk').val();
				$(".banknotes").each(function() {
					if ($(this).val() == '') {
						res += 0;
					} else {
						res += ($(this).val() * $(this).attr('id'));
					}
				});
				tip = (res - paydesk);
				$("#cash").val(res);
				$("#tip").val(tip);
			});
		</script>
	</body>
</html>