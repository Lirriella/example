<form action=<?php echo Main::getUrl()?> method="post">
  <h2>Добавить книгу</h2>
  <table class='table-content'>
    <tr>
      <td><?php echo Books::getLabels('title',true)?></td>
      <td><input type="text" name="Books[title]" value=<?php echo $book->title?>></td>
    </tr>
    <tr>
      <td><?php echo Books::getLabels('year',true)?></td>
      <td><input type="text" name="Books[year]" value=<?php echo $book->year?>></td>
    </tr>
    <tr>
      <td><?php echo Books::getLabels('author',true)?></td>
      <td><input type="text" name="Books[author]" value=<?php echo $book->author?>></td>
    </tr>
    <tr>
      <td><?php echo Books::getLabels('description',true)?></td>
      <td><input type="text" name="Books[description]" value=<?php echo $book->description?>></td>
    </tr>
    <tr>
      <td></td>
      <td><input class='button' type="submit" name="save" /></td>
    </tr>
  </table>
</form>