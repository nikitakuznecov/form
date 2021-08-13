{if $Users}
    {foreach $Users as $key => $value}
    <tr class="animated fadeIn">
        <td>{$value->getId()}</td>
        <td>{$value->getName()}</td>
        <td>{$value->getPhone()}</td>
        <td>{$value->getEmail()}</td>
        <td>
            {if count(json_decode($value->getPhoto())) > 0}
                {foreach json_decode($value->getPhoto()) as $k => $v}
                    <img src="{$v}" width="50px">
                {/foreach}
            {/if}

        </td>
    </tr>
    {/foreach}
{/if}