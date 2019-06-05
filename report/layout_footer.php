</div>
    <!-- /container -->
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../libs/vendor/js/jquery-3.2.1.min.js"></script>
 
<!-- Latest compiled and minified Bootstrap JavaScript -->
<script src="../libs/vendor/js/bootstrap-3.3.7.min.js"></script>
  
<!-- bootbox library -->
<script src="../libs/vendor/js/bootbox-4.4.0.min.js"></script>

<!-- JavaScript validators -->
<script src="../libs/js/validators.js"></script>

<script>
    var slides = document.querySelectorAll('#slides .slide');
    var currentSlide = 0;
    var slideInterval = setInterval(nextSlide,3000);

    function nextSlide() {
        slides[currentSlide].className = 'row slide';
        currentSlide = (currentSlide+1)%slides.length;
        slides[currentSlide].className = 'row slide showing';
    }
</script>

</body>
</html>