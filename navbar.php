	<?php
		if (isset($title))
		{
	?>
<nav class="navbar navbar-default ">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>       
      </button>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <li class="<?php if (isset($active_traductor)){echo $active_traductor;}?>"><a href="traductor.php"><i class='glyphicon glyphicon-search'></i> Traductor</a></li>
    <li class="<?php if (isset($active_principal)){echo $active_principal;}?>"><a href="principal.php"><i class='glyphicon glyphicon-folder-open'></i> Diccionario</a></li>
		<li class="<?php if (isset($active_idiomas)){echo $active_idiomas;}?>"><a href="idiomas.php"><i class='glyphicon glyphicon-tags'></i> Idiomas</a></li>
       </ul>
       <ul>
       <a class="navbar-brand" href="traductor.php">
          <li>
             TRADUCTOR UMG </a>
        </li>
       </ul>
    </div>
  </div>
</nav>
	<?php
		}
	?>