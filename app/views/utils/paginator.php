<nav aria-label="...">
    <ul class="pagination">



<?php

    foreach ($data as $page => $attr){
        ?>
        <li class="page-item <?=$attr['disabled']?>">
            <a class="page-link" href="?page=<?=$attr['href']?>"><?=$page?></a>
        </li>
        <?
    }
?>
    </ul>
</nav>
