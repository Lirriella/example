  <h2>Список книг</h2>
  <table class='table-content'>
    <tr>
      <td class='comment' colspan=2><input class='button' type="submit" name="add" value='Добавить' onclick="window.location='index.php?m=Books&a=Create';"/></td>
    </tr>
    <tr>
      <td class='comment' colspan=2>Введите название/автора книги (полностью или частично) и нажмите "Искать"</td>
    </tr>
    <tr>
      <td><input id='search' type="text" name="search"></td>
      <td><input id='search-button' class='button' type="submit" name="search" value='Искать'/></td>
    </tr>
  </table>

<div class='books'>
  <?php echo Books::getList()?>
</div>

<script>
  $("#search-button").click(function() {
    useAjax('index.php?m=Books&a=Search',$("#search").val());
  });
</script>