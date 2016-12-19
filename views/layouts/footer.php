<div class="page-buffer"></div>
</div>

<!-- Модальное Окно  -->
<div id="overlay">
	<div class="popup">
		<div class="signup-form"><!--sign up form-->
			<h5> Желаете подписаться на акционную рассылку?</h5>
			<br/>
			<form action="#" method="post">
				<p>Имя и фамилия</p>
				<input type="text" name="userText" placeholder="Имя и фамилия"/>
				<br/>
				<p>Ваша почта</p>
				<input type="email" name="userEmail" placeholder="E-mail"/>
				<input type="submit" name="submit" class="btn" value="Подписаться!"/>
			</form>
		</div>

		<button class="close" title="Закрыть"
		        onclick="document.getElementById('overlay').style.display='none';"></button>
	</div>
</div>


<footer id="footer" class="page-footer"><!--Footer-->
	<div class="footer-bottom">
		<div class="container">
			<div class="row">
				<p class="pull-left">Copyright © <?php echo date( 'Y' ); ?></p>
				<p class="pull-right">Veres Corp</p>
			</div>
		</div>
	</div>
</footer><!--/Footer-->


<script src="/template/js/jquery.js"></script>
<script src="/template/js/jquery.cycle2.min.js"></script>
<script src="/template/js/jquery.cycle2.carousel.min.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/jquery.scrollUp.min.js"></script>
<script src="/template/js/price-range.js"></script>
<script src="/template/js/jquery.prettyPhoto.js"></script>
<script src="/template/js/main.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://yandex.st/jquery/cookie/1.0/jquery.cookie.min.js"></script>
<script type="text/javascript" src="/template/js/jquery.arcticmodal.js"></script>
<script src="/template/js/dropdown-enhancement.js"></script>


<script type="text/javascript" src="/template/js/jquery-1.3.2.min.js"></script>


<script type="text/javascript" src="/template/js/init.js"></script>
<script type="text/javascript" src="/template/js/jquery.simplemodal.js"></script>
<script type="text/javascript" src="/template/js/jquery.arcticmodal.js"></script>
<script type="text/javascript" src="/template/js/jquery.simplePagination.js"></script>

<script type="text/javascript">
    $(function(){
        $("#search").keyup(function(){
            var search = $("#search").val();
            $.ajax({
                type: "POST",
                url: "/product/search",
                data: {"search": search},
                cache: false,
                success: function(response){
                    $("#resSearch").html(response);
                }
            });
            return false;
        });
    });
</script>

<script type="text/javascript" src="http://yandex.st/jquery/cookie/1.0/jquery.cookie.min.js"></script>


<script>
	$(document).ready(function () {
		$(".add-to-cart").click(function () {
			var id = $(this).attr("data-id");
			$.post("/cart/addAjax/" + id, {}, function (data) {
				$("#cart-count").html(data);
			});
			return false;
		});
	});
</script>

<script type="text/javascript">
	var delay_popup = 15000;
	setTimeout("document.getElementById('overlay').style.display='block'", delay_popup);
</script>


<script type="text/javascript">
	$(function () {
		$(".pag").pagination({
			items: 15,
			itemsOnPage: 5,
			pages: 5,
			currentPage: '<?php echo $page;?>',
			displayedPages: 1,
			hrefTextPrefix: '/category/<?php echo $page;?>/',
			cssStyle: 'compact-theme'

		});
	});
</script>

<script>
   $('#search_tags').keyup(function(){
       var Value = $('#search_tags').val();
       forNewDom('/news/search/'+Value, 0, 'tag_list');
       }
   );
       </script>


</body>
</html>