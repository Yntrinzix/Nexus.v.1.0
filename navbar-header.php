
            <div class="container">
            
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span> 
                  </button>
                  <a class="navbar-brand" href="#" id="logo-sm">Nexus</a>
                </div>
        
                <div class="collapse navbar-collapse" id="myNavbar">
                  <ul class="nav navbar-nav nav-fonts">
                    
                    <li class="active">
                      <a href="#">
                        <i class="fa fa-desktop" aria-hidden="true"></i>
                        <span class="nav-title">&nbsp;&nbsp;&nbsp;Dashboard</span>
                      </a>
                    </li>
                    
                    <li >
                      <a href="#" onclick="report()">
                          <i class="fa fa-line-chart" aria-hidden="true"></i>
                            <span class="nav-title">&nbsp;&nbsp;&nbsp;Report</span>
                        </a>
                    </li> 
					<?php
						
						if ($priv == 0)
						{
							echo '<li >
									<a href="#" onclick="report()">
									  <i class="fa fa-filter" aria-hidden="true"></i>
										<span class="nav-title">&nbsp;&nbsp;&nbsp;Filter Calendar</span>
									</a>
								 </li> ';
						}
							
					?>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                    <li><!-- User welcome info --><a href="#" id="username" tag="<?php echo $idEmp;?>">Welcome <?php echo $name; ?></a></li>
                    <li><a href="index.php"><i class="fa fa-power-off" aria-hidden="true"></i> Logout </a></li>
                  </ul>
                </div>
                </div>