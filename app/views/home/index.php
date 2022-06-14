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
			
			<?php if ($_COOKIE['login'] == '0939947369'): ?>

				<!--  -->
				<div class="tips">
					<h3>Витрачені чайові:</h3>
					<div class="inform">
						<input type="number" name="spentTips" id="spentTips" placeholder="Витрата" class="my-tip">
						<button class="btn btn-warning" id="spent-tips-btn">Зняти</button>
						<div class="spent-tip danger"><b><?=$data['spentTips']?> UAH</b></div>
					</div>
				</div>
				<div class="hr"></div>
				<div class="tips">
					<h3>Чайові:</h3>
					<div class="inform">
						<input type="number" name="tip" id="add-tip" placeholder="Чайові" class="my-tip">
						<button class="btn btn-success" id="tip-btn">Додати</button>
						<div class="my-tip success"><b><?=$data['tip']?> UAH</b></div>
					</div>
				</div>
				<div class="hr"></div>

			<?php endif; ?>

			<div class="cash<?=$data['class']?>">
				<h3>Підрахунок каси:</h3>
				<div class="inform">
					<input type="number" name="banknotes1000" id="1000" placeholder="1000 UAH" class="banknotes<?=$data['class']?>"<?=$data['attr']?>>
					<input type="number" name="banknotes500" id="500" placeholder="500 UAH" class="banknotes<?=$data['class']?>"<?=$data['attr']?>>
					<input type="number" name="banknotes200" id="200" placeholder="200 UAH" class="banknotes<?=$data['class']?>"<?=$data['attr']?>>
					<input type="number" name="banknotes100" id="100" placeholder="100 UAH" class="banknotes<?=$data['class']?>"<?=$data['attr']?>>
					<input type="number" name="banknotes50" id="50" placeholder="50 UAH" class="banknotes<?=$data['class']?>"<?=$data['attr']?>>
					<input type="number" name="banknotes20" id="20" placeholder="20 UAH" class="banknotes<?=$data['class']?>"<?=$data['attr']?>>
					<input type="number" name="banknotes10" id="10" placeholder="10 UAH" class="banknotes<?=$data['class']?>"<?=$data['attr']?>>
					<input type="number" name="banknotes5" id="5" placeholder="5 UAH" class="banknotes<?=$data['class']?>"<?=$data['attr']?>>
					<input type="number" name="banknotes2" id="2" placeholder="2 UAH" class="banknotes<?=$data['class']?>"<?=$data['attr']?>>
					<input type="number" name="banknotes1" id="1" placeholder="1 UAH" class="banknotes<?=$data['class']?>"<?=$data['attr']?>>
					<input type="number" name="paydesk" id="paydesk" placeholder="Каса UAH" class="paydesk<?=$data['class']?>"<?=$data['attr']?>>
					<input type="hidden" name="cash" id="cash" class="banknotes">
					<input type="hidden" name="tip" id="tip" class="banknotes">
					<button class="btn btn-dark<?=$data['btn-dis']?>" id="cash-btn"<?=$data['attr']?>>Рахувати</button>
				</div>
				<div class="info<?=$data['class']?>"><?=base64_decode($data['info'])?></div>
			</div>
			<div class="hr<?=$data['class']?>"></div>
			<div class="orders<?=$data['class']?>">
				<h3>Кількість заказів:</h3>
				<div class="inform<?=$data['class']?>">
					<input type="number" name="orders" id="orders" placeholder="Замовлення" class="all-orders<?=$data['class']?>"<?=$data['attr']?>>
					<div class="all-orders<?=$data['class']?> np d-flex justify-between align-center">
						<button class="btn-plus plus<?=$data['btn-dis']?>"<?=$data['attr']?>>+</button>
						<button class="btn-plus minus<?=$data['btn-dis']?>"<?=$data['attr']?>>–</button>
					</div>
					<!-- <input type="number" name="newPost" id="newPost" placeholder="НП" class="all-orders"> -->
					<button class="btn btn-dark<?=$data['btn-dis']?>" id="orders-btn"<?=$data['attr']?>>Додати</button>
				</div>
				<div class="menu-orders<?=$data['class']?>">
					<div class="everyday<?=$data['class']?>">
						<div><h4>Буденні дні:</h4></div>
						<div class="everyday__orders"><h5>Замовлення: <?=$data['orders']?> шт.</h5></div>
						<div class="everyday__new-post"><h5>Нова Пошта: <?=$data['newPost']?> шт.</h5></div>
					</div>
					<div class="weekend<?=$data['class']?>">
						<div><h4>Вихідні дні:</h4></div>
						<div class="weekend__orders"><h5>Замовлення: <?=$data['weekendOrders']?> шт.</h5></div>
						<div class="weekend__new-post"><h5>Нова Пошта: <?=$data['weekendNewPost']?> шт.</h5></div>
					</div>
				</div>
				<div class="full-orders<?=$data['class']?>"><h2 class="success<?=$data['class']?>">Замовлення: <?=$data['fullOrders']?> шт.</h2></div>
				<div class="salary<?=$data['class']?>"><h2 class="success<?=$data['class']?>">ЗП: <?=$data['salary']?> UAH</h2></div>
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

			$('#spent-tips-btn').click(function() {
				let spentTips = $('#spentTips').val();
				
				$.ajax({
					url: '/',
					type: 'POST',
					data: {'spentTips' : spentTips},
					dataType: 'html',
					cache: false,
					success: function(data) {
						$('#spentTips').val('');
					} 
				});
			});

			$('#tip-btn').click(function() {
				let addTip = $('#add-tip').val();
				
				$.ajax({
					url: '/',
					type: 'POST',
					data: {'addTip' : addTip},
					dataType: 'html',
					cache: false,
					success: function(data) {
						$('#add-tip').val('');
					} 
				});
			});

			$('#cash-btn').click(function() {	
				let paydesk = $('#paydesk').val();
				let cash = $('#cash').val();
				let tip = $('#tip').val();
				
				$.ajax({
					url: '/',
					type: 'POST',
					data: {'paydesk' : paydesk, 'cash' : cash, 'tip' : tip},
					dataType: 'html',
					cache: false,
					success: function(data) {
						$('#paydesk').val('');
						$('#cash').val('');
						$('#tip').val('');
						$('#1000').val('');
						$('#500').val('');
						$('#200').val('');
						$('#100').val('');
						$('#50').val('');
						$('#20').val('');
						$('#10').val('');
						$('#5').val('');
						$('#2').val('');
						$('#1').val('');
					} 
				});
			});

			$('#orders-btn').click(function() {
				let orders = $('#orders').val();
				let newPost = 0;
				
				$.ajax({
					url: '/',
					type: 'POST',
					data: {'orders' : orders, 'newPost' : newPost},
					dataType: 'html',
					cache: false,
					success: function(data) {
						$('#orders').val('');
					} 
				});
			});

			$('.plus').click(function() {
				$('.plus').css({
					"background" : "#008000",
					"color" : "#fff"
				});
				$('.plus').html('+1');
				let orders = 0;
				let newPost = 1;

				setTimeout(function() {
					$('.plus').css({
						"background" : "#fff",
						"color" : "#000"
					});
					$('.plus').html('+');
				}, 1000);
				
				$.ajax({
					url: '/',
					type: 'POST',
					data: {'orders' : orders, 'newPost' : newPost},
					dataType: 'html',
					cache: false,
					success: function(data) {
						$('#orders').val('');
					} 
				});
			});

			$('.minus').click(function() {
				$('.minus').css({
					"background" : "#ff2800",
					"color" : "#fff"
				});
				$('.minus').html('–1');
				let orders = 0;
				let newPost = -1;

				setTimeout(function() {
					$('.minus').css({
						"background" : "#fff",
						"color" : "#000"
					});
					$('.minus').html('–');
				}, 1000);
				
				$.ajax({
					url: '/',
					type: 'POST',
					data: {'orders' : orders, 'newPost' : newPost},
					dataType: 'html',
					cache: false,
					success: function(data) {
						$('#orders').val('');
					} 
				});
			});

			setInterval(function() {
				let salary = '<?=$data['salary']?>';

				$.ajax({
					url: 'public/php/ajax.php',
					type: 'POST',
					data: {'salary' : salary},
					dataType: 'html',
					cache: false,
					success: function(data) {
						data = JSON.parse(data);

						$('.spent-tip').html('<b>' + data['spentTips'] + ' UAH</b>');
						$('.my-tip').html('<b>' + data['tip'] + ' UAH</b>');

						$('.info').html(data['cash']);

						let classFullOrders = 'success';
						let classSalary = 'success';

						$('.everyday__orders').html('<h5>Замовлення: ' + data['orders'] + ' шт.</h5>');
						$('.everyday__new-post').html('<h5>Нова Пошта: ' + data['newPost'] + ' шт.</h5>');
						$('.weekend__orders').html('<h5>Замовлення: ' + data['weekendOrders'] + ' шт.</h5>');
						$('.weekend__new-post').html('<h5>Нова Пошта: ' + data['weekendNewPost'] + ' шт.</h5>');

						if (data['fullOrders'] < 1000) {
							classFullOrders = 'warning';
						}
						if ('<?=$data['class']?>' != '') {
							classFullOrders = '<?=$data['class']?>';
						}
						$('.full-orders').html('<h2 class="' + classFullOrders + '">Замовлення: ' + data['fullOrders'] + ' шт.</h2>');

						if (data['salary'] < 15000) {
							classSalary = 'danger';
						} else if (data['salary'] < 20000) {
							classSalary = 'warning';
						}
						if ('<?=$data['class']?>' != '') {
							classSalary = '<?=$data['class']?>';
						}
						$('.salary').html('<h2 class="' + classSalary + '">ЗП: ' + data['salary'] + ' UAH</h2>');
					}
				});
			}, 1000);
		</script>
	</body>
</html>