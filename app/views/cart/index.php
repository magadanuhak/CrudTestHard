Cart Content
<hr>
<table border="1">
  <tr>
    <td>Name</td>
    <td></td>
  </tr>
    <? foreach ($data as $item) {?>
      <tr>
        <td><?=$item['id']?></td>
        <? if(\site\app\core\User::getInstance()->isAuthorised()){?>
        <td><a href="cart/remove/<?=$item['id']?>">+</a></td>
        <? }?>
      </tr>
    <?}?>
</table>
