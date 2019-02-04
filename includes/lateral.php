
<?php require_once 'includes/helpers.php'; ?>
<!--BARRA LATERAL-->
    <aside id="sidebar">
        <?php if(isset($_SESSION['usuario'])) : ?>
        <div id="usuario-logueado" class="bloque">
      <h3>Bienvenido<?=$_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'];?></h3>
        <?php var_dump($_SESSION['usuario']);?>
        </div>  
        <?php endif; ?>
        <div id="login" class="bloque">
            <h3>Identificate</h3>
            <form action="login.php" method="POST">
                <label for ="email">Email</label>
                <input type="email" name="email"/></br>

                 <label for ="Password">Contraseña</label>
                 <input type="password" name="Password"/></br>

                 <input type="submit" value="Entrar"/>  </br>
           </form>
        </div>
          <!--REGISTRO BLOQUE-->
          
         <div id="register" class="bloque">
              <!--para imprimir dentro del codiho html-->
            
            <h3>Registrate</h3>
            <!--Mostrar errores-->
            <?php if(isset($_SESSION['completado'])): ?>
            <div class="alerta alerta-exito">
                <?=$_SESSION['completado']?>
            </div>
            <?php elseif(isset($_SESSION['errores']['general'])): ?>
            <div class="alerta alerta-exito">
                <?=$_SESSION['errores']['general']?>
            </div>
             <?php endif; ?>
            <form action="registro.php" method="POST">
                <label for ="nombre">Nombre</label>
                <input type="text" name="nombre"/></br>
                <?php echo isset($_SESSION['errores'])? mostrarError($_SESSION['errores'],'nombre') : ''; ?>
                
                 <label for ="apellidos">Apellidos</label>
                <input type="text" name="apellidos"/></br>
                <?php echo isset($_SESSION['errores'])? mostrarError($_SESSION['errores'],'apellidos') : ''; ?>
                
                 <label for ="email">Email</label>
                 <input type="email" name="email"/></br>
                 <?php echo isset($_SESSION['errores'])? mostrarError($_SESSION['errores'],'email') : ''; ?>
                 
                 <label for ="Password">Contraseña</label></br>
                 <input type="password" name="password"/></br>
                  <?php echo isset($_SESSION['errores'])? mostrarError($_SESSION['errores'],'password') : ''; ?>
                 <input type="submit" name="submit" value="Registrar"/>  </br>
           </form>
            
        </div>
    </aside>
