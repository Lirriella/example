  <h2>������ ����</h2>
  <table class='table-content'>
    <tr>
      <td class='comment' colspan=2><input class='button' type="submit" name="add" value='��������' onclick="window.location='index.php?m=Books&a=Create';"/></td>
    </tr>
    <tr>
      <td class='comment' colspan=2>������� ��������/������ ����� (��������� ��� ��������) � ������� "������"</td>
    </tr>
    <tr>
      <td><input id='search' type="text" name="search"></td>
      <td><input id='search-button' class='button' type="submit" name="search" value='������'/></td>
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