<!-- <nav class="navbar navbar-expand-md bg-info navbar-dark fixed-top  " >
  <div class="container">
  <a class="navbar-brand" href="#">SNS</a>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto" >
    
        <li>
          <img src="views/i/imagen1.png" alt="logo" style="width: 40px" >
      </li>  
    </ul>
  </div>  
</div>
</nav> -->
<nav class="navbar navbar-expand-md bg-info navbar-dark fixed-top  " >
 <div class="container">
 
  <a class="navbar-brand" href="#">SNS</a>
  <img src="i/imagen1.png" alt="" style="width: 40px">

  <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class="nav-link  text-white  " href="index.php?action=perfil">Inicio</a>
      </li> 
          <li class="nav-item">
        <a class="nav-link text-white " href="index.php?action=registros/registrar_aprendiz">Registar aprendiz</a>
      </li> 
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle text-white " href="aplazamiento.php" id="navbardrop" data-toggle="dropdown">
        Novedades
      </a>
      <div class="dropdown-menu">
      <a class="dropdown-item text-dark " href="index.php?action=registros/form_novedades"> Registrar Novedad</a>
        <a class="dropdown-item text-dark " href="index.php?action=consultar_novedad"> Consultar</a>
      </div>
    </li> 
    

   
    <li class="nav-item">
        <a class="nav-link text-white " href="index.php?action=salir">Salir</a>
      </li>  
      
    </ul>
    
     
  </div>  
 </div>
</nav> 