{if $Users}
    <table class="table table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>Имя</th>
            <th>Телефон</th>
            <th>E-mail</th>
            <th>Изображения</th>
        </tr>
        </thead>
        <tbody>
        {foreach $Users as $key => $value}
            <tr>
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
        </tbody>
    </table>
{/if}