<?php
    require('assets/php/requirements.php');

    $login = new login(false, false, true);

    $login->setMYSQL('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

    $login->getData();

    $login->login_check('index.php');

    $mysql = new mysqli('riverspoon.one.mysql', 'riverspoon_one', 'sascha', 'riverspoon_one');

    $wheels = $mysql->query("SELECT * FROM wheel")->fetch_all();
    
    
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hake - Reifeneinlagerung</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="assets/css/datepicker3.css" rel="stylesheet">
	<link href="assets/css/styles.css" rel="stylesheet">
	<link href="assets/css/hake.min.css" rel="stylesheet">

	<style>
	.results tr[visible='false'],
.no-result{
  display:none;
}

.results tr[visible='true']{
  display:table-row;
}
	</style>
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Hake</span>Admin</a>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
                <img src="../images/team/<?php echo $login->getUserData()[0]; ?>.png" class="img-responsive" alt="<?php echo str_replace('_', ' ', $login->getUserData()[0]); ?>">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?php echo str_replace('_', ' ', $login->getUserData()[0]) ?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">
			<li><a href="dash.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li class="parent ">
				<a data-toggle="collapse" href="#pages">
					<em class="fa fa-navicon">&nbsp;</em> Pages <span data-toggle="collapse" href="#pages" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="pages">
				<?php if($login->hasPerm($login->getUserData()[0], 'homepage')){ ?>
					<li>
						<a href="home.php">
							<span class="fa fa fa-home">&nbsp;</span> Homepage
						</a>
					</li>
				<?php } ?>

<?php if($login->hasPerm($login->getUserData()[0], 'services')){ ?>
					<li>
						<a href="services.php">
							<span class="fa fa-handshake-o">&nbsp;</span> Services
						</a>
					</li>
				<?php } ?>

				<?php if($login->hasPerm($login->getUserData()[0], 'about')){ ?>
					<li>
						<a href="about.php">
							<span class="fa fa-info">&nbsp;</span> Über uns
						</a>
					</li>
				<?php } ?>

				<?php if($login->hasPerm($login->getUserData()[0], 'contact')){ ?>
					<li>
						<a href="contact.php">
							<span class="fa fa-address-card">&nbsp;</span> Contact
						</a>
					</li>
				<?php } ?>

				</ul>
			</li>
            <?php if($login->hasPerm($login->getUserData()[0], 'admin.users')){ ?>
                <li><a href="users.php"><em class="fa fa-users">&nbsp;</em> Benutzer & Gruppen</a></li>
            <?php } ?>
            <li><a href="profil.php"><em class="fa fa-user">&nbsp;</em> Profil</a></li>
            <li class="active"><a href="wheel.php"><em class="fa fa-cog">&nbsp;</em> Reifeneinlagerung</a></li>
            <li><a href="index.php?logout=true"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Reifeneinlagerung</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12 form-group pull-righ">
				<h1 class="page-header">Reifeneinlagerung</h1>

	

  			  <div class="form-group pull-right">
    <input type="text" class="search form-control" placeholder="Kundenname/Kennzeichen">
</div>
		
			</div>
		</div><!--/.row-->
        
        <table class="table table-bordered table table-hover table-bordered results">
 <thead>
 <tr>
 <th>Einlagerungs-Nr</th>
 <th>Oben/Unten</th>
 <th>Kunden</th>
 <th>Kennzeichen</th>
 <th>Sommer/Winter</th>
 <th>ALU/Stahl</th>

 </tr>
 </thead>
 <tbody>
 <tr>
			<?php
			
			foreach($wheels as $test)
			{
				echo"<td>".$test[0]."</td>";
				echo"<td>".$test[1]."</td>";
				echo"<td>".$test[2]."</td>";
				echo"<td>".$test[3]."</td>";
				echo"<td>".$test[4]."</td>";
				echo"<td>".$test[5]."</td>";				
				echo "</tr>";
			}
			?>
			
    <tr class="warning no-result">
      <td colspan="6"><i class="fa fa-warning"></i> No result</td>
    </tr>
</table>

		
		<div class="row">
			<div class="col-sm-12">
				<p class="back-link">created by Sascha W. & Timo J.</p>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/chart.min.js"></script>
	<script src="assets/js/chart-data.js"></script>
	<script src="assets/js/easypiechart.js"></script>
	<script src="assets/js/easypiechart-data.js"></script>
	<script src="assets/js/bootstrap-datepicker.js"></script>
	<script src="assets/js/custom.js"></script>
	<script src="assets/js/test.js"></script>
	
	<script>
	$(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
		  });
});$(document).ready(function() {
  $(".search").keyup(function () {
    var searchTerm = $(".search").val();
    var listItem = $('.results tbody').children('tr');
    var searchSplit = searchTerm.replace(/ /g, "'):containsi('")
    
  $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
        return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
    }
  });
    
  $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','false');
  });

  $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
    $(this).attr('visible','true');
  });

  var jobCount = $('.results tbody tr[visible="true"]').length;
    $('.counter').text(jobCount + ' item');

  if(jobCount == '0') {$('.no-result').show();}
    else {$('.no-result').hide();}
		  });
});
	</script>

</body>
</html>