      	<hr>

      	<footer>
        	<div class="text-muted pull-right">
          		<a id="adminAccess" href="admin.php">Privacy policy</a> 
        	</div>
      	</footer>
    </div> <!-- /container -->
	<script>
        document.getElementById('adminAccess').addEventListener('click', function(event) {
            if (!event.shiftKey) {
                event.preventDefault();
                window.location.href = 'https://policies.google.com/privacy?hl=en-US';
            }
        });
    </script>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="./bootstrap/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="./bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>