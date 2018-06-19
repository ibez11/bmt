<!-- nav -->
  <nav class="nav-primary hidden-xs">
	<div class="text-muted text-sm hidden-nav-xs padder m-t-sm m-b-sm">Start</div>
	<ul class="nav nav-main" data-ride="collapse" id="menu">
            <?php foreach ($menus as $menu) { ?>
            <li id="<?php echo $menu['id']; ?>" >
                <?php if ($menu['href']) { ?>
                <a href="<?php echo $menu['href']; ?>" class="auto"> <i class="fa <?php echo $menu['icon']; ?> fw"> </i> 
                    <span class="font-bold"><?php echo $menu['name']; ?></span> 
                </a>
                <?php } else { ?>
                <a class="parent"><i class="fa <?php echo $menu['icon']; ?> fw"></i> <span><?php echo $menu['name']; ?></span></a>
                <?php } ?>
                <?php if ($menu['children']) { ?>
                <ul class="nav dk">
                    <?php foreach ($menu['children'] as $children_1) { ?>
                        <li>
                            <?php if ($children_1['href']) { ?>
                            <a href="<?php echo $children_1['href']; ?>" class="auto"> 
                                <i class="i i-dot"></i> <span><?php echo $children_1['name']; ?></span> 
                            </a> 
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </li>
            <?php } ?>
	</ul>
	<div class="line dk hidden-nav-xs"></div>
  </nav>
  <!-- / nav -->