<?php 
    if(isset($_GET['cat_id']))
    $first = $_GET['cat_id'];

?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title></title>
    <?php wp_head();?>
</head>

<body <?php body_class();?>>

    <nav class="navbar navbar-expand-md bg-primary navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="<?= get_home_url() ?>"><?= get_bloginfo('name') ?></a>


        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse pc-6" id="collapsibleNavbar">
            <ul class="navbar-nav mx-auto">
                <?php
				$categories_principal = get_categories( array(
				    'orderby' => 'name',
					'parent'  => 2
				));
				foreach ( $categories_principal as $category_principal ){
                    $active = "";
                    if(!isset($first)){
                        $active = 'class="active"';
                        $first = $category_principal->term_id;
                    }
            ?>
                <li class="nav-item">
                    <a href="?cat_id=<?= $category_principal->term_id ?>" class="nav-link"><?php echo $category_principal->name;?></a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </nav>

    <!-- NAV 2 -->
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler ml-auto text-size-1" type="button" data-toggle="collapse" data-target="#collapsibleNavbar2">
            <span class="navbar-toggler-icon mr-2"></span>Sous categories
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar2">
            <ul class="navbar-nav mx-auto" id="filters">
                <li class="nav-item vikser" data-filter=".vikser">
                    <a class="nav-link" onclick="changerSousCategorie('Tous')">Tous</a>
                </li>

                <?php
                global $header_var;
                $header_var = $first;

				$categories_principal = get_categories( array(
				    'orderby' => 'name',
					'parent'  => $first
				));
				foreach ( $categories_principal as $category_principal ){
            ?>
                <li class="nav-item cat<?php echo $category_principal->cat_ID;?>" data-filter=".cat<?php echo $category_principal->cat_ID;?>">
                    <a class="nav-link" onclick="changerSousCategorie('<?php echo $category_principal->cat_name;?>')">
                        <?php echo $category_principal->name;?>
                    </a>
                </li>
                <?php } ?>

            </ul>
        </div>
    </nav>

    <?= $_GET['test'] ?>
