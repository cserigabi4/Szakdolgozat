{foreach $items as $item}
    <li class="nav-item  text-dark">
        <a class="nav-link text-light" href="{$item['url']}">{$item['title']}</a>
    </li>
{/foreach}
