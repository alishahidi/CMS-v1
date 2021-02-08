
<?php
require_once(BASE_PATH . "/template/panel/layouts/header-tag.php");
?>

<head>
    <style>
    .maintag {
        padding-left: 0 !important;
        padding-right: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
</head>


<section class="navmenu">
    <ul id="navmenulist" class="navmenulist">
        <li>
            <div class="link"><a class="text-info" href="<?= url("menu/create/menu")?>"><i
                        class="fa fa-plus"></i>ساخت منو جدید</a></div>
        </li>
        <?php
        $i = 0;
        foreach ($menus as $menu){
            ?>
        <li>
            <section class="link pr-3 ">
                <?php echo htmlentities($menu['name'])?>
                <i class="fa fa-chevron-down"></i>
                <i class="fa fa-cog" aria-hidden="true" onclick="showCog(<?php echo $i  ?>)" onmouseover="showCog(<?php echo $i  ?>)"></i>
                <section class="option-cog" id="option-cog" onmouseleave="closeCog(<?php echo $i  ?>)">
                    <section class="option-menu">
                    <span class="close d-flex justify-content-center close pointer" onclick="closeCog(<?php echo $i  ?>)">&times;</span>

                        <a href="<?= url("menu/edit/menu/".$menu['id'])?>">
                            <i class="fas fa-edit"></i><span class="icon-details text-dark">ویرایش</span>
                        </a>
                    </section>
                    <section class="option-menu">
                        <a href="<?= url("menu/delete/".$menu['id'])?>">
                            <i class="fa fa-trash" aria-hidden="true"></i><span
                                class="icon-details text-dark">حذف</span>
                        </a>

                    </section>
                    <section class="clear-fix"></section>
                </section>
                <section class="clear-fix"></section>
            </section>
            <ul class="submenu">
                <?php
            $submenussql = "SELECT `name`,`id`,`parent_id` FROM `menus` WHERE `parent_id` = ? ";
            $submenus = $db->select($submenussql,[$menu['id']]);

            foreach ($submenus as $submenu){
                $i++;
                ?>
                <li class="position-relative">
                    <a href="#" class="submenu-link"><?php echo htmlentities($submenu['name'])?>
                    </a><i class="fa fa-cog" aria-hidden="true" onclick="showCog(<?php echo $i  ?>)" onmouseover="showCog(<?php echo $i  ?>)"></i>
                    <section class="option-cog" id="option-cog" onmouseleave="closeCog(<?php echo $i  ?>)">
                    <span class="close d-flex justify-content-center close" onclick="closeCog(<?php echo $i  ?>)">&times;</span>

                        <section class="option-menu">
                            <a
                                href="<?= url("menu/edit/submenu/".$submenu['id'])?>">
                                <i class="fas fa-edit"></i><span class="icon-details text-dark">ویرایش</span>
                            </a>
                        </section>
                        <section class="option-menu">
                            <a href="<?= url("menu/delete/".$submenu['id'])?>">
                                <i class="fa fa-trash" aria-hidden="true"></i><span
                                    class="icon-details text-dark">حذف</span>
                            </a>

                        </section>
                        <section class="clear-fix"></section>
                    </section>
                </li>
                <?
            }
           ?>
                <li><a class="text-info creat-new-submneu submenu-link"
                        href="<?= url("menu/create/submenu/".$menu['id']) ?>">ساخت
                        زیر منو جدید</a></li>
            </ul>
        </li>
        <?php $i++; }?>
    </ul>
</section>


<?php
require_once(BASE_PATH . "/template/panel/layouts/footer-tag.php");
?>

