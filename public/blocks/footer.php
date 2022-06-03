<footer class="footer">
    <div class="footer__box container">
        <div class="nasty">
            <h4>Nasty &copy; 2022</h4>
        </div>
        <div class="alexproger">
            <a href="https://alexproger.com"><h4>@AlexProger.com</h4></a>
        </div>
    </div>
    <div class="ua"><h3 id="ua">Слава Україні</h3></div>
</footer>

<script src="public/js/jquery360.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    var arrUA = ['Героям Слава', 'Слава Нації', 'Смерть Ворогам', 'Україна понад усе', 'Все буде Україна', 'Слава Україні'];
    var i = 0;
    setInterval( () => {
        if (i == (arrUA.length - 1)) {
            $('#ua').text(arrUA[i]);
            i = 0;
        } else {
            $('#ua').text(arrUA[i]);
            i++;
        }
    }, 2000);
</script>